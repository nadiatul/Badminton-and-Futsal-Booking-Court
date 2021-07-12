Hello
<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <link href='https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@5.8.0/main.min.css' rel='stylesheet' />
        <script src='https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@5.8.0/main.min.js'></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/luxon/1.26.0/luxon.min.js"></script>

        <script>
        <?php
            $resources = isset($resources) ? $resources : [];
            $type = isset($type) ? $type : '';
        ?>
        var resources = <?php echo $resources ?>;
        var type = '<?php echo $type ?>';
        var newResources = [];
        resources.forEach((e,i)=> {
            newResources[i] = {
                id: e.id,
                title: e.name
            }
        })

        var test;
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                timeZone: 'UTC',
                selectable: true,
                initialView: 'resourceTimelineDay',
                aspectRatio: 1.5,
                headerToolbar: {
                    left: 'prev,next',
                    center: 'title',
                    right: 'resourceTimelineDay,resourceTimelineWeek,resourceTimelineMonth'
                },
                resourceAreaHeaderContent: 'Rooms',
                resources: newResources,
                events: 'https://fullcalendar.io/demo-events.json?single-day&for-resource-timeline',
                dateClick: function(info) {

                    // alert('clicked ' + info.dateStr + ' on resource ' + info.resource.id);
                },
                select: function(info) {
                    // alert('selected ' + info.startStr + ' to ' + info.endStr);
                                        // alert('clicked ' + JSON.stringify(info));
                    // alert('clicked ' + info.dateStr);
                    test = info;
                    // $('#name').html(info.resource.title);
                    // const value = moment('2014-08-20 15:30:00').format('DD/MM/YYYY h:mm a');

                    // const getDate((value) => {
                    //     return
                    // })
                    $('#id').val(info.resource.id);
                    $('#type').val(type);
                    $('#statusId').val(1);
                    $('#sportFieldId').val(info.resource.id);
                    $('#name').val(info.resource.title);
                    $('#startingTime').val('2021-06-22 23:02:40');
                    // $('#startingTime').val(info.startStr);
                    $('#endingTime').val('2021-06-22 23:02:40');
                    // $('#endingTime').val(info.endStr);
                    $("#exampleModal").modal('show');
                    $('#name').html()

                }
            });
            calendar.render();
        });

          </script>
    </head>
    <body>
        @if(isset($message))
        <div class="alert alert-primary" role="alert">
          {{$message}}
        </div>
        @endif

        <form action = "/scheduleA" method = "post">
            <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
            <select class="form-select" aria-label="Default select example" name="id">
                <option selected>Open this select menu</option>
                @if(count($dropdown) > 0)
                    @foreach($dropdown as $row)
                        <option value="{{$row->id}}"> {{$row->name}} </option>
                    @endforeach
                @endif
            </select>
             <input name="type" type='text' value="{{$type}}"/>
            <input type='submit' value="Select Location"/>
        </form>
                    
        <div id='calendar' height="500px;"></div>
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
             <form action = "/store" method = "post">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                                <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
                                <table>
                                <tr>
                                    <td>Name </td>
                                    <td><input id="name" type='text' name='name' /></td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td><input id="statusId" type="text" name='statusId'/></td>
                                </tr>                       
                                <tr>
                                    <td>Sport Type</td>
                                    <td>  <input id="type" type='text' name="type" /></td>
                                </tr>
                                <tr>
                                    <td>Sport Field ID</td>
                                    <td><input id="sportFieldId" type="text" name='sport_field_id'/></td>
                                </tr>
                                <tr>
                                    <td>Start Time</td>
                                    <td><input id="startingTime" type="text" name='start_date'/></td>
                                </tr>
                                <tr>
                                    <td>End Time</td>
                                    <td><input id="endingTime" type="text" name='end_date'/></td>
                                </tr>
                                </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
             </form>
        </div>
    </body>
</html>
