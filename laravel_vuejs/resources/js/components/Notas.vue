<template> 
   <form> 
      <div class="form-group"> 
         <label> Descripción </label> 
         <input type="text" class="form-control" v-model="nota_temp.descripcion" /> 
      </div> 
      <button type="button" class="btn btn-primary" v-on:click="guardarNota()"> Guardar nota </button> 
      <hr /> 
      <ul> 
         <li v-for="n in notas">
          <span style="float: left; width: 40%;">
            <template v-if="!n.estado">{{ n.descripcion }}</template>
            <strike v-else>{{ n.descripcion }}</strike>
          </span>| 
            <a href="#" class="text text-default" v-on:click="terminarNota(n)"> <template v-if="!n.estado">Finalizar tarea</template><template v-else>Activar tarea</template></a> - 
            <a href="#" class="text text-danger" v-on:click="eliminarNota(n)"> Eliminar </a>
         </li> 
      </ul> 
   </form> 
</template> 
 
<script> 
 export default { 
    data(){ 
       return { 
          nota_temp: { 
             descripcion: '' 
          }, 
          notas: [] 
       }
    }, 
    methods: { 
       mostrarNotas(){ 
          this.$http.get('/mostrar_notas').then(response => { 
             this.notas = response.body; 
          }, response => { 
             alert('Error'); 
          }); 
       }, 
       guardarNota(){ 
          this.$http.post('/guardar_nota', { 
             descripcion: this.nota_temp.descripcion 
          }).then(response => { 
             this.nota_temp.descripcion = ''; 
             this.notas = response.body; 
          }, response => { 
             alert('Error'); 
          }); 
       },
       terminarNota(p_nota){
          this.$http.post('/terminar_nota', {
            id: p_nota.id
          }).then(response => {
            this.notas = response.body;
          }, response => {
             alert('Error');
          });
       }, 
       eliminarNota(p_nota){ 
          this.$http.post('/eliminar_nota', { 
             id: p_nota.id 
          }).then(response => { 
             this.notas = response.body; 
          }, response => { 
             alert('Error'); 
          }); 
       }
    },
    created(){ 
       this.mostrarNotas(); 
    } 
 } 
</script>