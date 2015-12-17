
$(document).ready(function ($) {
	$.ajax({
		type: "GET",
		url: member_feed_path,
		data: "perpage=4",
		dataType: "json",
		success: function(data) {
			//var obj = jQuery.parseJSON(data);
			//if the dataType is not specified as json uncomment this
			// do what ever you want with the server response
			if(data.status_code=='0')
			{
				var index;
				var a = data.data;
				var members_feed = '';
				for (index = 0; index < a.length; ++index) {
				    var name = a[index].name;
					var message2 = a[index].message2;
					var created_at = a[index].created_at;
					var commentable_type = a[index].commentable_type;
					var commentable_id = a[index].commentable_id;

					members_feed += 
					'<li>'+
	                    '<p><a href="'+commentable_type+'/'+commentable_id+'">@'+name+' </a> '+message2+'</p>'+
	                    '<span>'+created_at+'</span>'+
	                '</li>';
				}

				$("#members_feed").html(members_feed);
				console.log(data.data);
			}else{
				console.log(data);
			}
		},
		error: function(data){
			console.log(data);
		}
	});
});