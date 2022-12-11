<template>
    <div class="modal" :class="{mostrar:modal}" >
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Detalles curso</h4>
        <button type="button" @click="closeModal()" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div class="my-4">
            <label for="nombre">Nombre</label>
            <input v-model="course.name"  type="text" class="form-control" id="nombre" placeholder="Nombre del curso" disabled>
        </div>
        <div class="my-4">
            <label for="creditos">Creditos del curso</label>
            <input v-model="course.credits" type="text" class="form-control" id="creditos" placeholder="Creditos del curso" disabled>
        </div>
        <div class="my-4">
            <label for="profesor">Profesor</label>
            <input v-model="course.teacher_name" type="text" class="form-control" id="profesor" placeholder="Profesor del curso" disabled>
        </div>
        <div class="my-4">
            <label for="prerrequisito">Prerrequisito</label>
            <input v-model="course.prerequisit" type="text" class="form-control" id="prerrequisito" placeholder="prerrequisito del curso" disabled>
        </div>
        <div class="my-4">
            <label for="horasAutonomas">Horas autonomas</label>
            <input v-model="course.autonomy_hours" type="number" class="form-control" id="horasAutonomas" placeholder="Horas autonomas del curso" disabled>
        </div>
        <div class="my-4">
            <label for="horasSincronicas">Horas sincronicas</label>
            <input v-model="course.directed_hours" type="number" class="form-control" id="horasSincronicas" placeholder="Horas sincronicas del curso" disabled>
        </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" @click="closeModal()" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
      </div>

    </div>
  </div>
</div>


 <tr v-for="semester in semesters" :key="semester.id">
    <div class="card" v-if="semester.courses.length>0">
        <div class="card-header">
         Semestre {{semester.Semester_number}}
        </div>
        <div class="card-body my-4">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Creditos</th>
                        <th>Profesor</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="course in semester.courses" :key="course.id">
                        <td>{{course.name}}</td>
                        <td>{{course.credits}}</td>
                        <td>{{course.teacher_name}}</td>
                        
                        <td>
                            <div class="btn-group" role="group" aria-label="">
                                <!-- <router-link :to="{name:'EditCategory',params:{id:category.id}}" class="btn btn-primary">Editar</router-link> -->
                                <button type="button"  @click="openModal(course)" class="btn btn-info">Ver más</button>        
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>

    </div>


</tr>

    
</template>


<script>
import axios from 'axios';

export default {
    data(){
        return{
            semesters:[
        ],
        courses:[],
        modal:0,
        course:{},

        }
    },
    created:function(){
        // axios.get('/courses').then(res=>{
        //     this.courses=res.data;
        // });
        axios.get('/semesters').then(res=>{
            this.semesters=res.data;
            console.log(res)
            console.log("prueba")
        })
        

    },
    methods:{
        openModal(data){
            this.modal=1;
            this.id=data.id;
            this.course.name=data.name;
            this.course.credits=data.credits;
            this.course.teacher_name=data.teacher_name;
            this.course.prerequisit=data.prerequisit;
            this.course.autonomy_hours=data.autonomy_hours;
            this.course.directed_hours=data.directed_hours;
        
        },
        closeModal(){
            this.modal=0;
        },
        async getdata(){
            
            
           
            
        }

    }
    
}
</script>

<style>
.mostrar{
    display: list-item;
    opacity: 100%;
    background: rgb(54, 52, 52);

}
</style>