<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>calendar</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="Build whatever layout you need with our Architect framework.">
    <meta name="msapplication-tap-highlight" content="no">
    <link href="./assets/css/main.css" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/fullcalendar1.css">

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
  <script>
   
  $(document).ready(function() {
   var calendar = $('#calendar').fullCalendar({
    editable:true,
    header:{
     left:'prev,next today',
     center:'title',
     right:'agendaWeek,agendaDay,listWeek'
    },
    
    
    events: 'calendar-load.php',
    defaultView: 'agendaWeek',
    selectable:true,
    selectHelper:true,
    eventConstraint : {//限制拖拽拖放的位置（即限制有些地方拖不進去）：an event ID, "businessHours", object
    start: '08:00', // a start time (10am in this example)
    end: '20:00', // an end time (6pm in this example)
                dow: [ 1, 2, 3, 4,5,6,0 ] // days of week. an array of zero-based day of week integers (0=Sunday) (Monday-Thursday in this example)
            },
   
    minTime:"08:00:00",
    maxTime:"20:00:00",
    slotDuration:'4:00:00',
    allDaySlot : false,//顯示全天選項
    eventDurationEditable:true,
    displayEventEnd:true,//顯示結束日期

    eventRender: function (event, element, view) {
    element.find('.fc-title').append('<div class="hr-line-solid-no-margin"></div><span style="font-size: 10px">' + event.price+ '</span></div>');//顯示價錢
  
},

    select: function(start, end)
    {//彈跳視窗
    var title = prompt("Enter Event Title"); 
     var price=prompt("Enter Event price");
     if(title,price)
     {
      var start = $.fullCalendar.formatDate(start,"Y-MM-DD  HH:mm:ss" );
      var end = $.fullCalendar.formatDate(end,"Y-MM-DD HH:mm:ss" );

    
      $.ajax({
       url:"calendar-insert.php",
       type:"POST",
       data:{title:title, price:price, start:start, end:end},
       success:function()
       {
        calendar.fullCalendar('refetchEvents');//Refetches events from all sources and rerenders them on the screen.
        
        alert("Added Successfully");
       }
      })
     }
    },
  
    editable:true,//編輯效果
    eventResize:function(event)//縮放效果
    {
     var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
     var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
     var title = event.title;
     var price = event.price;
     var id = event.id;
     $.ajax({
      url:"calendar-update.php",
      type:"POST",
      data:{title:title, price:price, start:start, end:end,id:id},
      success:function(){
       calendar.fullCalendar('refetchEvents');
       alert('Event Update');
      }
     })
    },

    eventDrop:function(event)//拖曳效果
    {
     var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
     var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
     var price = event.price;
     var title = event.title;
     var id = event.id;
     $.ajax({
      url:"calendar-update.php",
      type:"POST",
      data:{title:title,  price:price,start:start, end:end, id:id},
      success:function()
      {
       calendar.fullCalendar('refetchEvents');
       alert("Event Updated");
      }
     });
    },

    eventClick:function(event)//事件點擊，設定為刪除
    {
     if(confirm("Are you sure you want to remove it?"))
     {
      var id = event.id;
      $.ajax({
       url:"calendar-delete.php",
       type:"POST",
       data:{id:id},
       success:function()
       {
        calendar.fullCalendar('refetchEvents');
        alert("Event Removed");
       }
      })
     }
    },

   });
  });
 
  </script>
  <style>
#calendar {
    max-width: 2400px;
    margin: 0 auto;
};


</style>
</head>

<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        <?php require_once("./main-header.php") ?>
        <div class="app-main">
            <?php require_once("./main-menu.php") ?>
            <div class="app-main__outer">
                <div class="app-main__inner"> <!-- main start -->
                    <div class="tab-content">
                    <br >
  <h2 align="center"><a href="#">預約時間</a></h2>
  <br />
  <div class="container">
   <div id="calendar"></div>
  </div>
                    </div>
                </div> <!-- main end -->
                <div class="app-wrapper-footer"> <!-- footer start -->
                    <div class="app-footer">
                        <div class="app-footer__inner"></div>
                    </div>
                </div> <!-- footer end -->
            </div>
        </div>
    </div>
   
    <script type="text/javascript" src="./assets/scripts/jjj.js"></script>
</body>

</html>