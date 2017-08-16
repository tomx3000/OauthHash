
<template lang="html">
	<div id="mobilediv">
		<br>
		 <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">Mobile</a></li>
    <li><a data-toggle="tab" href="#menu1">Bank</a></li>
    <li><a data-toggle="tab" href="#menu2">All</a></li>
    <li class="pull-right"> <input type="text" v-model="searchtext" placeholder="search"></li>	
  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
      <h3>Mobile</h3>
      <div class="container">   
  <table class="table table-hover">
    <thead>
      <tr >
        <th>From</th>
        <th>Amount</th>
       <th>Account</th>
        <th>Payment Date</th>
        
      </tr>
    </thead>
    <tbody>
      <tr v-for="transaction in currentTransaction" v-if="transaction.payeeaccounttype==Mobileaccount">
        <td >{{transaction.payerphonenumber}}</td>
        <td>{{transaction.amount}}</td>
        <td>{{transaction.payeeaccounttype}}</td>
        <td>{{transaction.created_at}}</td>
      </tr>

    </tbody>
  </table>

      <div class="container list-group">
		    <span  class="list-group-item">
		    <h3 class="list-group-item-heading">Total Amount</h3>
		   <h4 class="list-group-item-heading ">{{totalmobile}}</h4>
		
		    </span>
		 
		</div>
</div>
    </div>
    <div id="menu1" class="tab-pane fade">
      <h3>Bank</h3>
      <div class="container">   
  <table class="table table-hover">
    <thead>
      <tr >
        <th>From</th>
        <th>Amount</th>
        <th>Account</th>
        <th>Payment Date</th>
        
      </tr>
    </thead>
    <tbody>
      <tr v-for="transaction in currentTransaction" v-if="transaction.payeeaccounttype==Bankaccount">
        <td >{{transaction.payerphonenumber}}</td>
        <td>{{transaction.amount}}</td>
        <td>{{transaction.payeeaccounttype}}</td>
        <td>{{transaction.created_at}}</td>
      </tr>
     
    </tbody>
  </table>
  <div class="container list-group">
		    <span  class="list-group-item">
		    <h3 class="list-group-item-heading">Total Amount</h3>
		   <h4 class="list-group-item-heading ">{{totalbank}}</h4>
		
		    </span>
		 
		</div>
</div>
    </div>
    <div id="menu2" class="tab-pane fade">
      <h3>All</h3>
      <div class="container">   
  <table class="table table-hover">
    <thead>
      <tr >
        <th>From</th>
        <th>Amount</th>
        <th>Account</th>
        <th>Payment Date</th>
        
      </tr>
    </thead>
    <tbody>
      <tr v-for="transaction in currentTransaction">
        <td >{{transaction.payerphonenumber}}</td>
        <td>{{transaction.amount}}</td>
        <td>{{transaction.payeeaccounttype}}</td>
        <td>{{transaction.created_at}}</td>
      </tr>
     
    </tbody>
  </table>
  <div class="container list-group">
		    <span  class="list-group-item">
		    <h3 class="list-group-item-heading">Total Amount</h3>
		   <h4 class="list-group-item-heading ">{{totalall}}</h4>
		
		    </span>
		 
		</div>
</div>
    </div>
    
  </div>
</div>

	</div>
</template>
<script>
	export default{
		data(){
			return{
				totalmobile:0,
				totalbank:0,
				totalall:0,
				searchtext:"",
				Bankaccount:"Bank",
				Mobileaccount:"Mobile",
				currenttransaction:[],
				errors:[],
				databserespo:"no respo"
				

			}
		},
		methods:{
			
			searchingTransations(keyword,transactionobject){
				
				var trans=[];
				$.each(transactionobject, function(key, value) {
				     if(value.payerphonenumber.indexOf(keyword)>=0||value.amount.indexOf(keyword)>=0||value.payeeaccounttype.toLowerCase().indexOf(keyword.toLowerCase())>=0){
					trans.push(value);
					}
				   });
				
				return trans;
			},
			getTotal:function(keyword,transactionobject){
				var total=0;
				$.each(transactionobject, function(key, value) {
				     if(value.payeeaccounttype.toLowerCase().indexOf(keyword.toLowerCase())>=0){
					total+=parseInt(value.amount);
					}
				   });
				
				return total;

			}

		},
		filters:{


		},
		watch:{
			searchtext:function(){
			// this.currenttransaction=this.currenttransaction.filter(function(tran){
   //      	if(this.searchtext=="mobile"){
   //      		false;
   //      	}
   //      	});

			}
			
		},
		computed:{
			currentTransaction: function(){
				 axios.get('/get/transactions')
			    .then(response => {
			      // JSON responses are automatically parsed.
			      this.currenttransaction = response.data
			    })
			    .catch(e => {
			      this.errors.push(e)
			    })
       			if(this.searchtext.length>=1){
       				this.currenttransaction=this.searchingTransations(this.searchtext,this.currenttransaction)
   				
   				}
   				this.totalmobile=this.getTotal("mobile",this.currenttransaction);
   				this.totalbank=this.getTotal("bank",this.currenttransaction);
   				this.totalall=this.totalbank+this.totalmobile;
			    return this.currenttransaction;

			}

		}

	}
</script>
<style lang="css">

#spanlistphones:hover{
background-color: #05aae6;
}	
.tab-pane.fade{
	max-height: 300px;
	overflow-y: auto;
	overflow-x: auto;


}

</style>