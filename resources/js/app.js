

import './bootstrap';
import { createApp } from 'vue';



const app = createApp({});

import ExampleComponent from './components/ExampleComponent.vue';
import GetCourses from './components/GetCourses.vue';
import Students from './components/Students.vue'
app.component('example-component', ExampleComponent);
app.component('getc', GetCourses);
app.component('students', Students)



app.mount('#app');
