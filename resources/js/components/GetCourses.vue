<template>
 <!-- Button to Open the Modal -->

    <div class="container">
        <button  type="button" @click="modifi=false; openModal()" class="btn btn-primary my-4" >
  Nueva materia
</button>

<button  type="button" @click="openModalSemester()" class="btn btn-warning my-4 mx-4" >
  Nuevo semestre
</button>
<form v-on:submit.prevent="saveSemester">
<!-- Modal crear semestre -->
<div class="modal" :class="{mostrar:modalSemester}" >
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Crear semestre</h4>
        <button type="button" @click="closeModalSemester()" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div class="my-4">
            <label for="nombre">Número de semestre</label>
            <input v-model="semester.Semester_number" min="1"  type="number" class="form-control" id="nombre" placeholder="Numero del semestre" required>
        </div>
        <div class="my-4">
            <label for="creditos">Descripción</label>
            <input v-model="semester.description" type="text" class="form-control" id="creditos" placeholder="Descripción" required>
        </div>
        
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" @click="closeModalSemester()" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button submit"  class="btn btn-success mx-4" data-bs-dismiss="modal" >Guardar</button>
      </div>

    </div>
  </div>
</div>
</form>







<!-- The Modal -->
<form v-on:submit.prevent="saveCourse">
<div class="modal" :class="{mostrar:modal}" >
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">{{titleModal}}</h4>
        <button type="button" @click="closeModal()" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      
      <div class="modal-body">
       
        <div class="my-4">
            <label for="nombre">Nombre</label>
            <input v-model="course.name"  type="text" class="form-control" id="nombre" placeholder="Nombre del curso" required/>
        </div>
        
        <div class="my-4">
            <label for="creditos">Creditos del curso</label>
            <input v-model="course.credits" type="text" class="form-control" id="creditos" placeholder="Creditos del curso" required>
        </div>
        <div class="my-4">
            <label for="profesor">Profesor</label>
            <input v-model="course.teacher_name" type="text" class="form-control" id="profesor" placeholder="Profesor del curso" required>
        </div>
        <div class="my-4">
            <label for="prerrequisito">Prerrequisito</label>
            <input v-model="course.prerequisit"  type="text" class="form-control" id="prerrequisito"  placeholder="prerrequisito del curso" required>
        </div>
        <div class="my-4">
            <label for="horasAutonomas">Horas autonomas</label>
            <input v-model="course.autonomy_hours" type="number" min="1" class="form-control" id="horasAutonomas" placeholder="Horas autonomas del curso" required>
        </div>
        <div class="my-4">
            <label for="horasSincronicas">Horas sincronicas</label>
            <input v-model="course.directed_hours" type="number" min="1" class="form-control" id="horasSincronicas" placeholder="Horas sincronicas del curso" required>
        </div>
        <div class="my-4">
            <label for="horasSincronicas">Semestre</label>
            <select v-model="course.semester_id"  class="form-select" >
                    <option v-for="semester in semesters" v-bind:value="semester.id" :key="semester.id" >
                        {{ semester.Semester_number }}
                    </option>
                    </select>
        </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" @click="closeModal()" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button submit"  class="btn btn-success mx-4" data-bs-dismiss="modal">Guardar</button>
      </div>
    

    </div>
  </div>
</div>
</form>
        <div class="row">
        </div>
        <div class="card">
        <div class="card-header">
            Asignaturas
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Creditos</th>
                        <th>Profesor</th>
                        <th>Prerequisito</th>
                        <th>Horas autonomas</th>
                        <th>Horas sincronicas</th>
                        <th>Semestre</th>
                        <th>Acciones</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="course in courses" :key="course.id">
                        <td>{{course.name}}</td>
                        <td>{{course.credits}}</td>
                        <td>{{course.teacher_name}}</td>
                        <td>{{course.prerequisit}}</td>
                        <td>{{course.autonomy_hours}}</td>
                        <td>{{course.directed_hours}}</td>
                        <td>{{course.semester.Semester_number}}</td>
                        <td>
                            <div class="btn-group" role="group" aria-label="">
                                <!-- <router-link :to="{name:'EditCategory',params:{id:category.id}}" class="btn btn-primary">Editar</router-link> -->
                                <button type="button" @click="modifi=true; openModal(course)" class="btn btn-warning">Editar</button>
                                <button type="button" @click="deleteCourse(course.id)" class="btn btn-danger mx-4">Borrar</button>
                                
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            
        </div>

    </div>

</div>
    

</template>
<script>


export default {

    data(){
        return{
            course:{
                name:'',
                credits:'',
                teacher_name:'',
                prerequisit:'',
                autonomy_hours:1,
                directed_hours:1,
                semester_id:0
            },
            id:0,
            modifi:false,
            modal:0,
            modalSemester:0,
            semester:{},
            titleModal:'',
            courses:[],
            semesters:[],
        }

    },
    methods:{
        getCourses(){
            axios.get('/courses').then(res=>{
            this.courses=res.data;
            console.log(res.data);
        })
        },
        getSemesters(){
            axios.get('/semesters').then(res=>{
            this.semesters=res.data;
        })

        }
        ,
        
        deleteCourse(id){
            axios.delete(`/courses/${id}`).then(()=>{
                console.log("Ok");
                axios.get('/courses').then(res=>{
                this.courses=res.data;
                });
                this.getCourses();
            }
            )
        },
        openModal(data={}){
            this.modal=1;
            if(this.modifi){
                this.titleModal="Modificar curso";
                this.id=data.id;
                this.course.name=data.name;
                this.course.credits=data.credits;
                this.course.teacher_name=data.teacher_name;
                this.course.prerequisit=data.prerequisit;
                this.course.autonomy_hours=data.autonomy_hours;
                this.course.directed_hours=data.directed_hours;
            }else{
                this.id=0;
                this.titleModal="Crear curso";
                this.course.name='';
                this.course.credits='';
                this.course.teacher_name='';
                this.course.prerequisit='';
                this.course.autonomy_hours=0;
                this.course.directed_hours=0;
            }

            
        },
        closeModal(){
            this.modal=0;
        },
        openModalSemester(){
            this.modalSemester=1;
            this.semester.Semester_number=0;
            this.semester.description='';
        },
        closeModalSemester(){
            this.modalSemester=0;
        },
        saveCourse(){
            if(this.modifi){
                axios.put(`/courses/${this.id}`,this.course)
            }else{
                
                axios.post('/courses',this.course)
            }
            this.closeModal();
            axios.get('/courses').then(res=>{
            this.courses=res.data;
        })
            
        },
        saveSemester(){
            axios.post('/semesters',this.semester);
            this.modalSemester=0;
            this.getCourses();
            this.getSemesters();
        }
    },
    created:function(){
        this.getCourses();   
        this.getSemesters();
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