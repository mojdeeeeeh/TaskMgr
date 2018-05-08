import main from './components/main.vue'
import VuePersianDatetimePicker from 'vue-persian-datetime-picker';

Vue.component('date-picker', VuePersianDatetimePicker);

// Vue.component('sinCalc',{
// 	template:`
// 		<div>
// 			<input type="number" v-model="sinValue" />
// 			Result sin : {{ outputSin }} /  {{ sinValue }}
// 			<input type="button" value="Calc" @click="getC" />
// 		</div>
// 	`,

// 	props: ['sin'],

// 	created(){
//  		this.sinValue = parseInt(this.sin);
// 	},

// 	data(){
// 		return {
// 			sinValue: 0,
// 			outputSin: 0,
// 		};
// 	},

// 	methods:{
// 		getC(){
// 			this.outputSin = Math.sin(this.sinValue);
// 		}
// 	}
// });

// new Vue({
// 	el: '#app',
// 	data:{

// 	}
// });

new Vue({
	el: '#app',

	components:{
		calculator : main,

	}
})