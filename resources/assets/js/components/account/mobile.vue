
<template lang="html">
	<div id="mobilediv">
		<input type="text" v-model="phonenumber" placeholder="Enter phone to add">
		{{progresstext}}<br>
		<div id="phones">
			<div class="list-group">
		    <span id="spanlistphones" class="list-group-item" v-for="phone in currentMobile"  v-on:mouseover="showTrash" v-on:mouseleave="hideTrash">
		      <h4 class="list-group-item-heading">{{phone.companyname}}</h4>
		      <i id="trashphone" class="fa fa-trash pull-right w3-xlarge w3-teal"  v-if="showtrash" v-on:click="sendPhone(phone)"></i>
		      <p class="list-group-item-text">{{phone.phonenumber}}</p>

		    </span>
		   
		  </div>

		</div>
		<br>
		<!-- <button class="btn btn-primary" v-on:click="storeData">test</button>
		<br>{{databserespo}} -->

	</div>
</template>
<script>
	export default{
		data(){
			return{
				mpesacodes:["0754","0755","0767"],
				airtelmoneycodes:["0684","0787","0789"],
				tigopesacodes:["0655","0654"],
				currentmobile:[],
				errors:[],
				databserespo:"no respo",
				showtrash:false,
				editphoneinput:'',
				phonenumber:"",
				mobilecompany:"",
				progresstext:''

			}
		},
		methods:{
			showProgress:_.debounce(function(){
				this.progresstext="adding phone";
				this.getMobileCompany();

			},1000),
			getMobileCompany:_.debounce(function(){
				this.progresstext="";
				this.mobilecompany=this.getCompanyCode(this.phonenumber);
				if(this.mobilecompany){
					if(this.phonenumber.length==10){
				this.storeInputData({"company":this.mobilecompany,"phonenumber":this.phonenumber})
				}
				
			}
				

			},1000),
			editPhone:function(){
				if(this.editbool){
				this.editphoneinput='<input type="text" v-model="phonenumber" placeholder="">';
				this.editbool=false;
				}else{
					this.editphoneinput="edited";
					this.editbool=true;
				}
			},
			storeData:function(){
				 axios.post('/store/phone', {
			      "company":"voda","phonenumber":"0754619721"
			    })
			    .then(response => {

			    	this.databserespo=response.data
			    })
			    .catch(e => {
			      this.errors.push(e)
			    })
						
			},
			storeInputData:function(inputdata){
				 axios.post('/store/phone', inputdata)
			    .then(response => {

			    	this.databserespo=response.data
			    })
			    .catch(e => {
			      this.errors.push(e)
			    })
						
			},
			sendPhone:function(phone){
				// var tobesent={"id":phone.id}
				axios.delete('/delete/phone', {data:phone})
			    .then(response => {

			    	this.databserespo=response.data
			    	// alert(this.databserespo);
			    })
			    .catch(e => {
			      this.errors.push(e)
			    })

			},
			showTrash:function(){
				this.showtrash=true;
			},
			hideTrash:function(){
				this.showtrash=false;
			},getCompanyCode: function(phone){

				var ccode="";
				if(phone.startsWith("+255")){
					phone=phone.replace("+255","0");
				}else if(phone.startsWith("255")){
					phone=phone.replace("255","0");
				}
				
				for(var codes in this.mpesacodes){
					if(phone.startsWith(this.mpesacodes[codes]))
					ccode="Voda Mpesa";
				}

				for(var codes in this.airtelmoneycodes){
					if(phone.startsWith(this.airtelmoneycodes[codes]))
					ccode="Airtel Money";
				}

				for(var codes in this.tigopesacodes){
					if(phone.startsWith(this.tigopesacodes[codes]))
					ccode="Tigo Pesa";
				}
				return ccode;
			}

		},
		filters:{


		},
		watch:{
			phonenumber:function(){
				this.mobilecompany="";
				this.progresstext="";
				if(this.phonenumber.length==10){
				this.showProgress();
			}
			}
			
		},
		computed:{
			currentMobile: function(){
				 axios.get('/get/phones')
			    .then(response => {
			      // JSON responses are automatically parsed.
			      this.currentmobile = response.data
			    })
			    .catch(e => {
			      this.errors.push(e)
			    })

			    return this.currentmobile;

			}

		}

	}
</script>
<style lang="css">

#spanlistphones:hover{
background-color: #05aae6;
}	


</style>