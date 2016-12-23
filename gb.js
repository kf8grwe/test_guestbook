$( document ).ready(function() {
	getApproved();
	
	$('a[href="#approved"]').bind( "click", function() {
		showApproved();
	});
	
	$('a[href="#total"]').bind( "click", function() {
		showTotal();
	});
	
	$('a[href="#manage"]').bind( "click", function() {
		$('#approved').hide();
		$('#total').hide();
		$('#manage').show();
	});
	
	$('#captcha').bind( "click", function() {
		$('#captcha').attr('src','captcha.php?' + Math.random() * 50);
	});
});

function getApproved () {
	$.ajax({type: "POST", url: "message.php", data:'get_approved=1&start=0&end=5', 
		dataType:"text", timeout:3000, async:true,
		error: function(xhr) {
			console.log('Ошибка!'+xhr.status+' '+xhr.statusText); 
		},
		success: function(a) {
			a = JSON.parse(a);
			var html = '';
			a.forEach(function(entry) {
				html += '<div class="row"><div class="col-sm-6">' + entry[0] + ': ' + entry[1] + '</div></div>';
				html += '<div class="row"><div class="col-sm-12">' + entry[2] + '</div></div>';
				html += '<div class="row"><div class="col-sm-12">' + entry[3] + '</div></div><br>';
			});
			document.getElementById("approved-content").innerHTML=html;
		}  
	});
}

function getTotal () {
	$.ajax({type: "POST", url: "message.php", data:'get_total=1&start=0&end=50', 
		dataType:"text", timeout:3000, async:true,
		error: function(xhr) {
			console.log('Ошибка!'+xhr.status+' '+xhr.statusText); 
		},
		success: function(a) {
			a = JSON.parse(a);
			var html = '';
			a.forEach(function(entry) {
				html += '<div class="row"><div class="col-sm-2">' + entry[1] + '</div>';
				html += '<div class="col-sm-1"><a onclick="getById(' + entry[0] + ')"> #' + entry[0] + '</a></div>';
				html += '<div class="col-sm-3"><span>' + entry[2].substring(0, 24) + '...</span></div>';
				if (entry[3]>0) { html += '<div class="col-sm-2"><span> - approved</span></div></div>'; } else { html += '</div>'; } 
			});
			document.getElementById("total-content").innerHTML=html;
		}  
	});
}

function getById (id) {
	$.ajax({type: "POST", url: "message.php", data:'get_by_id=' + id, 
		dataType:"text", timeout:3000, async:true,
		error: function(xhr) {
			console.log('Ошибка!'+xhr.status+' '+xhr.statusText); 
		},
		success: function(a) {
			a = JSON.parse(a);
			var html = '';
			a.forEach(function(entry) {
				html += '<div class="row"><div class="col-sm-3">' + entry[0] + ', ' + entry[1] + '</div></div>';
				html += '<div class="row"><div class="col-sm-2">' + entry[2] + '</div></div>';
				html += '<div class="row"><div class="col-sm-3">' + entry[3] + '</div></div>';
				html += '<div class="row"><div class="col-sm-2">' + entry[4] + '</div></div>';
				html += '<div class="row"><div class="col-sm-2"><input type="button" onclick="approveById(' + id + ')" value="Approve"></div>';
				html += '<div class="col-sm-2"><input type="button" onclick="deleteById(' + id + ')" value="Delete"></div></div>'; 
			});
			document.getElementById("manage-content").innerHTML=html;
		}
	});
	$('#approved').hide();
	$('#total').hide();
	$('#manage').show();
}

function approveById (id) {
	$.ajax({type: "POST", url: "message.php", data:'approve_by_id=' + id, 
		dataType:"text", timeout:3000, async:true,
		error: function(xhr) {
			console.log('Ошибка!'+xhr.status+' '+xhr.statusText); 
		},
		success: function(a) {
			document.getElementById("manage-content").innerHTML='';
			showApproved();
		}
	});
}

function deleteById (id) {
	$.ajax({type: "POST", url: "message.php", data:"delete_by_id=" + id, 
		dataType:"text", timeout:3000, async:true,
		error: function(xhr) {
			console.log('Ошибка!'+xhr.status+' '+xhr.statusText); 
		},
		success: function(a) {
			showTotal()
			document.getElementById("manage-content").innerHTML='';
		}
	});
}

function addMessage(name, email, header, msg) {
	$.ajax({type: "POST", url: "message.php", data:"add=1&email=" + email + "&text=" + msg + "&header=" + header + "&name=" + name, 
		dataType:"text", timeout:10000, async:true,
		error: function(xhr) {
			console.log('Ошибка!'+xhr.status+' '+xhr.statusText); 
		},
		success: function(a) {
			if (a == "success") {
				showTotal();
				toggleForm();
			} else {
				alert('error: ' + a);
			}
		}
	});
}

function submitForm() {
	$.ajax({type: "POST", url: "captcha.php", data:"check_captcha=" + $('input[name="captcha"]').val(), 
		dataType:"text", timeout:30000, async:true,
		error: function(xhr) {
			console.log('Ошибка!'+xhr.status+' '+xhr.statusText); 
		},
		success: function(a) {
			if (a) {
				addMessage($('input[name="username"]').val(),$('input[name="email"]').val(),$('input[name="header"]').val(),$('textarea[name="text"]').val());
			} else {
				alert('invalid captcha');
			}
		}
	});
}

function showTotal() {
	getTotal();
	$('#manage').hide();
	$('#total').show();
	$('#approved').hide();
}

function showApproved() {
	getApproved();
	$('#manage').hide();
	$('#total').hide();
	$('#approved').show();
}

function toggleForm() {
	$('#write-btn').toggle();
	$('#submit-container').toggle();
}