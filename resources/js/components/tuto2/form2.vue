<template>
    <div class="panel panel-default">
        <div class="panel-heading">Informacion Profesores</div>

        <div class="panel-body">
            <form action="" v-on:submit.prevent="newProfesor()">
                <div class="form-group">
                    <label for="thought">Nombre</label>
                    <input type="text" class="form-control" name="thought" v-model="nombre">
                    <label for="thought">Nombre</label>
                    <input type="text" class="form-control" name="thought" v-model="salario">
                </div>
                <button type="submit" class="btn btn-primary">
                    Crear Profesor
                </button>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                description: ''
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods: {
            newProfesor() {
                const params = {
                    nombre: this.nombre,
                    salario: this.salario

                };
                this.nombre = '';
                this.salario = "";

                axios.post('/inicio', params)
                    .then((response) => {
                        const profesor = response.data;
                        this.$emit('new', profesor);
                    });
            }
        }
    }
</script>
