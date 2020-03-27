<template>

     <div>
         <form @submit.prevent="editarProfesor(profesor)" v-if="modoEditar">
             <h3>Editar nota</h3>
             <input type="text" class="form-control mb-2"
                    placeholder="Nombre de la nota" v-model="profesor.nombre">
             <input type="text" class="form-control mb-2"
                    placeholder="Descripción de la nota" v-model="profesor.salario">
             <button class="btn btn-warning" type="submit">Editar</button>
             <button class="btn btn-danger" type="submit"
                     @click="cancelarEdicion">Cancelar</button>
         </form>
         <form @submit.prevent="agregar" v-else>
             <h3>Agregar Profesor</h3>
             <input type="text" class="form-control mb-2"
                    placeholder="Nombre del Profesor" v-model="profesor.nombre">
             <input type="text" class="form-control mb-2"
                    placeholder="Salario del Profesor" v-model="profesor.salario">
             <button class="btn btn-primary" type="submit">Agregar</button>
         </form>
         <hr>
         <h3>Lista de Profesores:</h3>
         <ul class="list-group">
             <li class="list-group-item"
                 v-for="(item, index) of profesores" :key="index" >
                    <span class="badge badge-primary float-right">{{item.updated_at}}</span>
                 {{item.nombre}} - {{item.salario}}
                 <p>
                     <button class="btn btn-danger btn-sm"
                             @click="eliminarProfesor(item, index)">Eliminar</button>

                     <button class="btn btn-warning btn-sm"
                             @click="editarFormulario(item)">Editar</button>


                 </p>
             </li>
         </ul>
     </div>
</template>

<script>
    export default {
        data() {
          return{
              profesores: [],
              modoEditar: false,
              profesor: {nombre: '', salario: ''}
          }
        },
        created(){
            axios.get('/inicio').then(res=>{
                this.profesores = res.data;
            })
        },
        methods: {
            agregar() {
                if (this.profesor.nombre.trim() === '' || this.profesor.salario.trim() === '') {
                    alert('Debes completar todos los campos antes de guardar');
                    return;
                }
                const params = {
                    nombre: this.profesor.nombre,
                    salario: this.profesor.salario
                }
                //const profesorNuevo = this.profesor;
                this.profesor = {nombre: '', salario: ''};
                axios.post('/inicio', params)
                    .then((res) => {
                        //const profesorServidor = res.data;
                        this.profesores.push(res.data);
                    })
            },
            editarFormulario(item){
                this.profesor.nombre = item.nombre;
                this.profesor.salario = item.salario;
                this.profesor.id = item.id;
                this.modoEditar = true;
            },
            editarProfesor(profesor){
                const params = {nombre: profesor.nombre, salario: profesor.salario};
                axios.put(`/inicio/${profesor.id}`, params)
                    .then(res=>{
                        this.modoEditar = false;
                        const index = this.profesores.findIndex(item => item.id === profesor.id);
                        this.profesores[index] = res.data;
                        this.profesor = {nombre: '', salario: ''};
                    })
            },
            eliminarProfesor(profesor, index){
                const confirmacion = confirm(`Eliminar profesor ${profesor.nombre}`);
                if(confirmacion){
                    axios.delete(`/inicio/${profesor.id}`)
                        .then(()=>{
                            this.profesores.splice(index, 1);
                        })
                }
            },
            cancelarEdicion(){
                this.modoEditar = false;
                this.profesor = {nombre: '', salario: ''};
            }
        }
    }
</script>
