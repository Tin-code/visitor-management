/* globals Chart:false, feather:false */

function buildLineChart (label, dset) {
   
    feather.replace({ 'aria-hidden': 'true' })
   
    // Graphs
    var ctx = document.getElementById('myChart')
    // eslint-disable-next-line no-unused-vars
    var myChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: label,
        datasets: [{
          data:dset,
          lineTension: 0,
          backgroundColor: 'white',
          borderColor: '#007bff',
          borderWidth: 1,
          pointBackgroundColor: '#007bff'
        }]
      },
      options: {
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero: true
            }
          }]
        },
        legend: {
          display: false
        }
      }
    })
  }
  
  function buildPie(dset){
    let chart = new CanvasJS.Chart("chartContainer", {
      animationEnabled: true,
      title: {
        text: "Différents motifs de visite"
      },
      data: [{
        type: "pie",
        startAngle: 0,
        yValueFormatString: "##0.00\"%\"",
        indexLabel: "{label} {y}",
        dataPoints: dset
        
      }]
    })
    return chart;
  }
  let _SERVER_DATE="";
  
  
  function set_interval_dateFilter(){
    let datejour_du_server = nformat_date(new Date()); 
    datejour_du_server = nformat_date(new Date()) ;  
  
    document.getElementById("aujourdhui").setAttribute("data-ajourd1",datejour_du_server);
    document.getElementById("aujourdhui").setAttribute("data-ajourd2",datejour_du_server);
  
    // calcul date de hier
  
    let date_hier = "";
    let djour = new Date(datejour_du_server);// console.log(djour);
  
    let month = djour.getMonth() +1 ; 
  
    let year = djour.getFullYear();
  
    let datenum_hier = djour.getDate();
  
    if(datenum_hier == 1 ){
      if(month == 1){
        //1 janvier donc on on retourne au 31 decembre de l annee passée
        month=12;
        datenum_hier=31;
        year=year-1;
  
      }else{
      // on repart au mois passée 
      
        datenum_hier = new Date(year, month-1,0).getDate(); // dernier jour du mois
        month=month-1;
      }
    
    }else{
      datenum_hier = datenum_hier - 1;
    }
  
  
    datenum_hier = datenum_hier.toString();
    datenum_hier = padded(datenum_hier);
    month = month.toString();
    month = padded(month); 
  
    date_hier=`${year}-${month}-${datenum_hier}` 
      
    document.getElementById("hier").setAttribute("data-hier1",date_hier);
    document.getElementById("hier").setAttribute("data-hier2",date_hier);
  
    //  semain en cours
    let s = new WeekTool(new Date());
    let deb_semaine = nformat_date(s.get_current_week());
  
    document.getElementById("sem_enours").setAttribute("data-sem_enours1",deb_semaine);
    document.getElementById("sem_enours").setAttribute("data-sem_enours2",datejour_du_server);
  }
  
  function date_filterEvent(date_server){
  
        
  
      
        //click sur les racourcis
  
      $("#aujourdhui").click(function(event){
       // alert("ajax too much")
        $("#debut_date").val(event.currentTarget.getAttribute('data-ajourd1'));
        $("#fin_date").val(event.currentTarget.getAttribute('data-ajourd2'));
        ajaxr();
      });
      
      $("#hier").click(function(event){
      
        $("#debut_date").val(event.currentTarget.getAttribute('data-hier1'));
        $("#fin_date").val(event.currentTarget.getAttribute('data-hier2'));
        ajaxr()
      });
  
      // la semaine encours
  
      $("#sem_enours").click(function(event){
      
        $("#debut_date").val(event.currentTarget.getAttribute('data-sem_enours1'));
        $("#fin_date").val(event.currentTarget.getAttribute('data-sem_enours2'));
        ajaxr()
      });
  }
  
  function padded(num){
    if(num.length == 1){
      return "0"+num;
    }
    return num;
  }
  
  function ajaxr(){
    //_SERVER_DATE=nformat_date(new Date());
   // console.log( nformat_date(new Date()) );
    set_interval_dateFilter();
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        
        let resp = JSON.parse(this.responseText) ;
        let pie_dataset = resp.total_motif ; //console.log(pie_dataset)
        //console.log(resp.week)
        buildPie(pie_dataset).render();
        $("#debut_date").val(resp.interval[0]);
        $("#fin_date").val(resp.interval[1]);
        $("#nb_visitor").text(resp.nb_reception);
        let label = [];
        let dset = [];
    
        for( let row of resp.week){
          label.push( `${row.day_fr}- ${row.jour}` );
          dset.push(row.counter);
        }
        buildLineChart (label, dset);
        //
      }
    };
    xhttp.open("GET", "graph_update?debut_date="+ $("#debut_date").val() +"&fin_date="+$("#fin_date").val(), true);
    xhttp.send();
           
  }
  window.onload = function() {
        _SERVER_DATE=nformat_date(new Date())

        // changement de date
        ajaxr();
        $("#debut_date").change(function(){  ajaxr(); });
        $("#fin_date").change(function(){ ajaxr(); });
        date_filterEvent();  // later we should use server date 
     
  }
  
  class WeekTool{
    
    
    constructor(current_date){
      this.current_date =current_date; 
      this.new_current_date = this.current_date;
      this.date_number = this.new_current_date.getDate();
      this.week_number = this.new_current_date.getDay();
      this.day_to_remove_val = 0 ;
      this.begin_week ="";
      this.last_week_day= "";
      this.last_first_week_day ="";
    }
  
    get_current_week(){
   
        this.day_to_remove(); 
        this.begin_week = this.date_number - this.day_to_remove_val ;
        this.new_current_date.setDate(this.begin_week); 
        return this.new_current_date;
    }
  
    get_last_week(){
      this.day_to_remove_val++;
      this.last_week_day= this.date_number - this.day_to_remove_val ;
      
    }
  
    day_to_remove(){
      
      switch(this.week_number ){
        case 0 :this.day_to_remove_val=6;
        break;
        case 1:
          break;
        case 2: this.day_to_remove_val = 1
        break;
        case 3: this.day_to_remove_val=2;
        break;
        case 4 : this.day_to_remove_val=3
        break;
        case 5: this.day_to_remove_val=4
        break;
        case 6: this.day_to_remove_val=5
        break;
      }
    }
  }
  
  class semaine_derniere{
    constructor(){
      
    }
  }
  
  let s = new WeekTool(new Date());
  console.log( s.get_current_week() )
  
  
  function nformat_date(d){
    let month = d.getMonth()+1 > 9 ? d.getMonth()+1: "0"+ (d.getMonth()+1)  ;
    let thedte = d.getDate() > 9 ? d.getDate(): "0"+ d.getDate()  ;
    return `${d.getFullYear()}-${month}-${thedte}`;
  }
  
  
  
  