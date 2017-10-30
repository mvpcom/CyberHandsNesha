function formhash(form, password) {
    // Create a new element input, this will be our hashed password field. 
    var p = document.createElement("input");
 
    // Add the new element to our form. 
    form.appendChild(p);
    p.name = "p";
    p.type = "hidden";
    p.value = hex_sha512(password.value);
 
    // Make sure the plaintext password doesn't get sent. 
    password.value = "";
 
    // Finally submit the form. 
    form.submit();
}
 
function regformhash(form, uid, email, password, conf) {
     // Check each field has a value
    if (uid.value == ''         || 
          email.value == ''     || 
          password.value == ''  || 
          conf.value == '') {
 
        alert('باید تمام اطلاعات خواسته شده را با دقت وارد نمایید!');
        return false;
    }
 
    // Check the username
 
    re = /^\w+$/; 
    if(!re.test(form.username.value)) { 
        alert("نام کاربری فقط می تواند شامل اعداد و حروف کوچک و بزرگ باشد. لطفا دوباره اقدام کنید."); 
        form.username.focus();
        return false; 
    }
 
    // Check that the password is sufficiently long (min 6 chars)
    // The check is duplicated below, but this is included to give more
    // specific guidance to the user
    if (password.value.length < 6) {
        alert('رمز عبور حداقل باید 6 کاراکتر باشد. دوباره تلاش کنید!');
        form.password.focus();
        return false;
    }
 
    // At least one number, one lowercase and one uppercase letter 
    // At least six characters 
 
    var re = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/; 
    if (!re.test(password.value)) {
        alert('رمز عبور باید شامل حداقل یک عدد، یک حرف کوچک و یک حرف بزرگ باشد، دوباره اقدام کنید!');
        return false;
    }
 
    // Check password and confirmation are the same
    if (password.value != conf.value) {
        alert('رمز عبور و تاییدیه ی آن با هم برابر نیستند. دوباره تلاش کنید!');
        form.password.focus();
        return false;
    }
 
    // Create a new element input, this will be our hashed password field. 
    var p = document.createElement("input");
 
    // Add the new element to our form. 
    form.appendChild(p);
    p.name = "p";
    p.type = "hidden";
    p.value = hex_sha512(password.value);
 
    // Make sure the plaintext password doesn't get sent. 
    password.value = "";
    conf.value = "";
 
    // Finally submit the form. 
    form.submit();
    return true;
}

function regformNewSession(form, SessionSubject, SessionPlace, SessionDate, SessionType, SessionHours, SessionReport) {
	

     // Check each field has a value
    if (SessionSubject.value == ''         || 
          SessionPlace.value == ''     || 
          SessionDate.value == ''  || 
          SessionType.value == ''  || 
          SessionHours.value == ''  || 
          SessionReport.value == '') {
 
        alert('باید تمام اطلاعات خواسته شده را با دقت وارد نمایید!');
        return false;
    }
 
    // Check the SessionSubject
 
    //re = /^\w+$/; 
	re= /^[\u0600-\u06FF\uFB8A\u067E\u0686\u06AF 0123456789]+$/;
    if(!re.test(form.SessionSubject.value)) { 
        alert("موضوع جلسه فقط می تواند شامل حروف و اعداد فارسی باشد!"); 
        form.SessionSubject.focus();
        return false; 
    }
	
 	re= /^[\u0600-\u06FF\uFB8A\u067E\u0686\u06AF 0123456789]+$/;
    if(!re.test(form.SessionPlace.value)) { 
        alert("محل نشست فقط می تواند شامل حروف و اعداد فارسی باشد!"); 
        form.SessionPlace.focus();
        return false; 
    }
 
    // Check that the SessionDate is sufficiently long (min 10 chars)
    // The check is duplicated below, but this is included to give more
    // specific guidance to the user
	re=/(\d{2})\/(\d{2})\/(\d{4})$/;
	if(!re.test(form.SessionDate.value)){         
        alert('تاریخ را به درستی بوسیله ی ابزار انتخاب تاریخ وارد کنید!');
        form.SessionDate.focus();
        return false;
	}
    

     // Check that the SessionType is between 1 to 6
    if (SessionType.value <  1 || SessionType.value >  6) {
        alert('ورودی غیر مجاز در نوع نشست!');
        form.SessionType.focus();
        return false;
    }
  	re= /^[1234567890]+$/;
    if(!re.test(form.SessionHours.value)) { 
        alert("در ورودی مدت برگزاری لطفا فقط از اعداد استفاده کنید!"); 
        form.SessionHours.focus();
        return false; 
    }

  	re= /^[\u0600-\u06FF\uFB8A\u067E\u0686\u06AF a-z0-9-~+.؟?#=!&;,/:%@$\|*()]+$/;
    if(!re.test(form.SessionReport.value)) { 
        alert("صورت جلسه فقط می تواند شامل اعداد و حروف فارسی باشد!"); 
        form.SessionReport.focus();
        return false; 
    }
	// Convert to Georgian Date for saving in DB
	var GD = document.createElement("input");
	form.appendChild(GD);
	GD.name = "GD";
	GD.type = "hidden";
	GD.value = dateGeorg;
	//window.alert(GD);
	//window.alert(dateGeorg);
    // Finally submit the form. 
	
	
	//var hr = new XMLHttpRequest();
	var hr;
	//var xmlhttp;
	if (window.XMLHttpRequest) {
		//code for IE7+, Firefox, Chrome, Opera, Safari
		hr = new XMLHttpRequest();
	} else if (window.ActiveXObject) {
		//code for IE6, IE5
		hr = new ActiveXObject("Microsoft.XMLHTTP");
	}			
	else {
		throw new Error("Ajax is not supported by this browser");
	}			
    // Create some variables we need to send to our PHP file
    var url = "insert.ajax.reg.php";
    var vars = 	'GD='+ GD.value + '&SessionSubject='+ SessionSubject.value + '&SessionPlace='+ SessionPlace.value + '&SessionDate='+ SessionDate.value + '&SessionType='+ SessionType.value + '&SessionHours='+ SessionHours.value +'&SessionReport=' + SessionReport.value;
    hr.open("POST", url, true);
    // Set content type header information for sending url encoded variables in the request
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    // Access the onreadystatechange event for the XMLHttpRequest object
    hr.onreadystatechange = function() {
	    if(hr.readyState == 4 && hr.status == 200) {
		    var return_data = hr.responseText;
			document.getElementById("Error_Response").innerHTML = hr.responseText;
	    }
    }
    // Send the data to PHP now... and wait for response to update the status div
    hr.send(vars); // Actually execute the request
	
	
    //form.submit();
    return true;
}

function regformNewMentor(form, MentorName, MentorFamily, MentorSex, MentorEmail, MentorMobileNo, MentorAddress) {
	

     // Check each field has a value
    if (MentorName.value == ''         || 
          MentorFamily.value == ''     || 
          MentorSex.value == ''  || 
          MentorEmail.value == ''  || 
          MentorMobileNo.value == ''  || 
          MentorAddress.value == '') {
 
        alert('باید تمام اطلاعات خواسته شده را با دقت وارد نمایید!');
        return false;
    }
 
    // Check the MentorName
 
    //re = /^\w+$/; 
	re= /^[\u0600-\u06FF\uFB8A\u067E\u0686\u06AF 0123456789]+$/;
    if(!re.test(form.MentorName.value)) { 
        alert("نام مربی فقط می تواند شامل حروف فارسی و اعداد باشد!"); 
        form.MentorName.focus();
        return false; 
    }
	
 	re= /^[\u0600-\u06FF\uFB8A\u067E\u0686\u06AF 0123456789]+$/;
    if(!re.test(form.MentorFamily.value)) { 
        alert("فمیل مربی  فقط باید شامل حروف و اعداد فارسی باشد!"); 
        form.MentorFamily.focus();
        return false; 
    }

     // Check that the MentorSex is between 1 to 2
    if (MentorSex.value <  1 || MentorSex.value >  2) {
        alert('لطفا جنسیت مربی را فقط بوسیله ی خود سیستم نشا تعیین کنید!');
        form.MentorSex.focus();
        return false;
    }
	
  	re= /^[1234567890+]+$/;
    if(!re.test(form.MentorMobileNo.value)) { 
        alert("لطفا از کاراکترهای غیر مجاز در شماره ی موبایل استفاده نکنید!"); 
        form.MentorMobileNo.focus();
        return false; 
    }

	// re= /^[\u0600-\u06FF\uFB8A\u067E\u0686\u06AF 0123456789]+$/;
    // if(!re.test(form.MentorEmail.value)) { 
        // alert("لطفا ایمیل را به شکل صحیح وارد کنید!"); 
        // form.MentorEmail.focus();
        // return false; 
    // }
	
	re= /^[\u0600-\u06FF\uFB8A\u067E\u0686\u06AF 0123456789]+$/;
    if(!re.test(form.MentorAddress.value)) { 
        alert("آدرس فقط می تواند شامل حروف و اعداد فارسی شود!"); 
        form.MentorAddress.focus();
        return false; 
    }
	
	var hr;
	//var xmlhttp;
	if (window.XMLHttpRequest) {
		//code for IE7+, Firefox, Chrome, Opera, Safari
		hr = new XMLHttpRequest();
	} else if (window.ActiveXObject) {
		//code for IE6, IE5
		hr = new ActiveXObject("Microsoft.XMLHTTP");
	}			
	else {
		throw new Error("Ajax is not supported by this browser");
	}			
    // Create some variables we need to send to our PHP file
    var url = "insert.ajax.reg.php";
    var vars = 	'MentorName='+ MentorName.value + '&MentorFamily='+ MentorFamily.value + '&MentorSex='+ MentorSex.value + '&MentorEmail='+ MentorEmail.value + '&MentorMobileNo='+ MentorMobileNo.value + '&MentorAddressID='+ MentorAddressID.value;
    hr.open("POST", url, true);
    // Set content type header information for sending url encoded variables in the request
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    // Access the onreadystatechange event for the XMLHttpRequest object
    hr.onreadystatechange = function() {
	    if(hr.readyState == 4 && hr.status == 200) {
		    var return_data = hr.responseText;
			document.getElementById("Error_Response").innerHTML = hr.responseText;
	    }
    }
    // Send the data to PHP now... and wait for response to update the status div
    hr.send(vars); // Actually execute the request
	
	
    //form.submit();
    return true;
}


function regformNewFaculty(form, FacultyName, FacultyFamily, FacultyGroup, FacultyNSN, FacultyMajor, FacultyMobileNo, FacultyGrade, FacultyEmail, FacultyAddress) {
	

     // Check each field has a value
    if (FacultyName.value == ''         || 
          FacultyFamily.value == ''     || 
          FacultyGroup.value == ''  || 
          FacultyNSN.value == ''  || 
          FacultyMajor.value == ''  || 
          FacultyMobileNo.value == ''|| 
          FacultyGrade.value == ''|| 
          FacultyEmail.value == ''|| 
          FacultyAddress.value == '') {
 
        alert('باید تمام اطلاعات خواسته شده را با دقت وارد نمایید!');
        return false;
    }
 
    // Check the FacultyName
 
    //re = /^\w+$/; 
	re= /^[\u0600-\u06FF\uFB8A\u067E\u0686\u06AF 0123456789]+$/;
    if(!re.test(form.FacultyName.value)) { 
        alert("نام شرکت کنند فقط می تواند شامل حروف و اعداد فارسی باشد!"); 
        form.FacultyName.focus();
        return false; 
    }
	
 	re= /^[\u0600-\u06FF\uFB8A\u067E\u0686\u06AF 0123456789]+$/;
    if(!re.test(form.FacultyFamily.value)) { 
        alert("نام خانوادگی شرکت کننده فقط می تواند شامل حروف و اعداد فارسی باشد!"); 
        form.FacultyFamily.focus();
        return false; 
    } 	
	re= /^[\u0600-\u06FF\uFB8A\u067E\u0686\u06AF 0123456789]+$/;
    if(!re.test(form.FacultyGroup.value)) { 
        alert("گروه آموزشی فقط می تواند شامل حروف و اعداد فارسی باشد!"); 
        form.FacultyGroup.focus();
        return false; 
    } 	
	 	
	re= /^[0123456789]+$/;
    if(!re.test(form.FacultyNSN.value)) { 
        alert("کد ملی فقط باید شامل عدد باشد!"); 
        form.FacultyNSN.focus();
        return false; 
    } 	
	 	
	re= /^[\u0600-\u06FF\uFB8A\u067E\u0686\u06AF 0123456789]+$/;
    if(!re.test(form.FacultyMajor.value)) { 
        alert("رشته ی تحصیلی فقط می تواند شامل حروف و اعداد فارسی باشد!"); 
        form.FacultyMajor.focus();	
        return false; 
    } 	
	
	re= /^[\u0600-\u06FF\uFB8A\u067E\u0686\u06AF 0123456789]+$/;
    if(!re.test(form.FacultyGrade.value)) { 
        alert("لطفا از کاراکترهای غیر مجاز در مرتبه ی علمی استفاده نکنید!"); 
        form.FacultyGrade.focus();
        return false; 
    }  


  	re= /^[1234567890+]+$/;
    if(!re.test(form.FacultyMobileNo.value)) { 
        alert("لطفا از کاراکترهای غیر مجاز در شماره ی موبایل استفاده نکنید!"); 
        form.FacultyMobileNo.focus();
        return false; 
    }

	// re= /^[\u0600-\u06FF\uFB8A\u067E\u0686\u06AF 0123456789]+$/;
    // if(!re.test(form.MentorEmail.value)) { 
        // alert("لطفا ایمیل را به شکل صحیح وارد کنید!"); 
        // form.MentorEmail.focus();
        // return false; 
    // }
	
	re= /^[\u0600-\u06FF\uFB8A\u067E\u0686\u06AF 0123456789]+$/;
    if(!re.test(form.FacultyAddress.value)) { 
        alert("آدرس فقط می تواند شامل حروف و اعداد فارسی شود!"); 
        form.FacultyAddress.focus();
        return false; 
    }
	
	var hr;
	//var xmlhttp;
	if (window.XMLHttpRequest) {
		//code for IE7+, Firefox, Chrome, Opera, Safari
		hr = new XMLHttpRequest();
	} else if (window.ActiveXObject) {
		//code for IE6, IE5
		hr = new ActiveXObject("Microsoft.XMLHTTP");
	}			
	else {
		throw new Error("Ajax is not supported by this browser");
	}			
    // Create some variables we need to send to our PHP file
    var url = "insert.ajax.reg.php";
    var vars = 	'FacultyName='+ FacultyName.value + '&FacultyFamily='+ FacultyFamily.value + '&FacultyGroup='+ FacultyGroup.value + '&FacultyNSN='+ FacultyNSN.value + '&FacultyMajor='+ FacultyMajor.value + '&FacultyMobileNo='+ FacultyMobileNo.value + '&FacultyGrade='+ FacultyGrade.value + '&FacultyEmail='+ FacultyEmail.value + '&FacultyAddress='+ FacultyAddress.value;
    hr.open("POST", url, true);
    // Set content type header information for sending url encoded variables in the request
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    // Access the onreadystatechange event for the XMLHttpRequest object
    hr.onreadystatechange = function() {
	    if(hr.readyState == 4 && hr.status == 200) {
		    var return_data = hr.responseText;
			document.getElementById("Error_Response").innerHTML = hr.responseText;
	    }
    }
    // Send the data to PHP now... and wait for response to update the status div
    hr.send(vars); // Actually execute the request
	
	
    //form.submit();
    return true;
}

function delSession(form, SessionSelector) {
	 		
			

     // Check each field has a value
    if (SessionSelector.value == '') {
        alert('باید تمام اطلاعات خواسته شده را با دقت وارد نمایید!');
        return false;
    }
    //alert(SessionSelector.value);
    //re = /^\w+$/; 
	re= /^[0123456789]+$/;
    if(!re.test(SessionSelector.value)) { 
        alert("لطفا از طریق صحیح بوسیله ی سیستم نشا گزینه ی مورد نظر را انتخا کنید!"); 
        form.SessionSelector.focus();
        return false; 
    }

	var hr;
	//var xmlhttp;
	if (window.XMLHttpRequest) {
		//code for IE7+, Firefox, Chrome, Opera, Safari
		hr = new XMLHttpRequest();
	} else if (window.ActiveXObject) {
		//code for IE6, IE5
		hr = new ActiveXObject("Microsoft.XMLHTTP");
	}			
	else {
		throw new Error("Ajax is not supported by this browser");
		alert("Ajax is not supported by this browser"); 
	}			
    // Create some variables we need to send to our PHP file
    var url = "delete.ajax.select.session.php";
    var vars = 	'SessionSelector='+ SessionSelector.value;
    hr.open("POST", url, true);
    // Set content type header information for sending url encoded variables in the request
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    // Access the onreadystatechange event for the XMLHttpRequest object
    hr.onreadystatechange = function() {
	    if(hr.readyState == 4 && hr.status == 200) {
		    var return_data = hr.responseText;
			document.getElementById("Error_Response").innerHTML = hr.responseText;
	    }
    }
    // Send the data to PHP now... and wait for response to update the status div
    hr.send(vars); // Actually execute the request
    //form.submit();
    return true;
}

function delFaculty(form, Selector) {
	 		
			

     // Check each field has a value
    if (Selector.value == '') {
        alert('باید تمام اطلاعات خواسته شده را با دقت وارد نمایید!');
        return false;
    }
    //alert(Selector.value);
    //re = /^\w+$/; 
	re= /^[0123456789]+$/;
    if(!re.test(Selector.value)) { 
        alert("لطفا از طریق صحیح بوسیله ی سیستم نشا گزینه ی مورد نظر را انتخا کنید!"); 
        form.Selector.focus();
        return false; 
    }

	var hr;
	//var xmlhttp;
	if (window.XMLHttpRequest) {
		//code for IE7+, Firefox, Chrome, Opera, Safari
		hr = new XMLHttpRequest();
	} else if (window.ActiveXObject) {
		//code for IE6, IE5
		hr = new ActiveXObject("Microsoft.XMLHTTP");
	}			
	else {
		throw new Error("Ajax is not supported by this browser");
		alert("Ajax is not supported by this browser"); 
	}			
    // Create some variables we need to send to our PHP file
    var url = "delete.ajax.select.faculty.php";
    var vars = 	'Selector='+ Selector.value;
    hr.open("POST", url, true);
    // Set content type header information for sending url encoded variables in the request
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    // Access the onreadystatechange event for the XMLHttpRequest object
    hr.onreadystatechange = function() {
	    if(hr.readyState == 4 && hr.status == 200) {
		    var return_data = hr.responseText;
			document.getElementById("Error_Response").innerHTML = hr.responseText;
	    }
    }
    // Send the data to PHP now... and wait for response to update the status div
    hr.send(vars); // Actually execute the request
    //form.submit();
    return true;
}

function delMentor(form, Selector) {
	 		
			

     // Check each field has a value
    if (Selector.value == '') {
        alert('باید تمام اطلاعات خواسته شده را با دقت وارد نمایید!');
        return false;
    }
    //alert(Selector.value);
    //re = /^\w+$/; 
	re= /^[0123456789]+$/;
    if(!re.test(Selector.value)) { 
        alert("لطفا از طریق صحیح بوسیله ی سیستم نشا گزینه ی مورد نظر را انتخا کنید!"); 
        form.Selector.focus();
        return false; 
    }

	var hr;
	//var xmlhttp;
	if (window.XMLHttpRequest) {
		//code for IE7+, Firefox, Chrome, Opera, Safari
		hr = new XMLHttpRequest();
	} else if (window.ActiveXObject) {
		//code for IE6, IE5
		hr = new ActiveXObject("Microsoft.XMLHTTP");
	}			
	else {
		throw new Error("Ajax is not supported by this browser");
		alert("Ajax is not supported by this browser"); 
	}			
    // Create some variables we need to send to our PHP file
    var url = "delete.ajax.select.mentor.php";
    var vars = 	'Selector='+ Selector.value;
    hr.open("POST", url, true);
    // Set content type header information for sending url encoded variables in the request
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    // Access the onreadystatechange event for the XMLHttpRequest object
    hr.onreadystatechange = function() {
	    if(hr.readyState == 4 && hr.status == 200) {
		    var return_data = hr.responseText;
			document.getElementById("Error_Response").innerHTML = hr.responseText;
	    }
    }
    // Send the data to PHP now... and wait for response to update the status div
    hr.send(vars); // Actually execute the request
    //form.submit();
    return true;
}
function CyberHandsSearch(form, searchbox) {
     // Check each field has a value
    if (searchbox.value == '') {
        //alert('حداقل خالی نفرست دیگه! می خوای تستم کنی؟!؟ من به خوبی تست شدم.');
        return false;
    }
    //alert(searchbox.value);
    //re = /^\w+$/; 
  	re= /^[\u0600-\u06FF\uFB8A\u067E\u0686\u06AF a-z0-9-~+.؟?#=!&;,/:%@$\|*()]+$/;
    if(!re.test(searchbox.value)) { 
        alert("لطفا از کاراکترهای غیر مجاز استفاده نکنید!"); 
        form.searchbox.focus();
        return false; 
    }

	var hr;
	//var xmlhttp;
	if (window.XMLHttpRequest) {
		//code for IE7+, Firefox, Chrome, Opera, Safari
		hr = new XMLHttpRequest();
	} else if (window.ActiveXObject) {
		//code for IE6, IE5
		hr = new ActiveXObject("Microsoft.XMLHTTP");
	}			
	else {
		throw new Error("Ajax is not supported by this browser");
		alert("Ajax is not supported by this browser"); 
	}			
    // Create some variables we need to send to our PHP file
    var url = "search.ajax.session.php";
    var vars = 	'searchbox='+ searchbox.value;
    hr.open("POST", url, true);
    // Set content type header information for sending url encoded variables in the request
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    // Access the onreadystatechange event for the XMLHttpRequest object
    hr.onreadystatechange = function() {
	    if(hr.readyState == 4 && hr.status == 200) {
		    var return_data = hr.responseText;
			document.getElementById("Session_Search").innerHTML = hr.responseText;
	    }
    }
    // Send the data to PHP now... and wait for response to update the status div
    hr.send(vars); // Actually execute the request    
	
	var hr2;
	if (window.XMLHttpRequest) {
		//code for IE7+, Firefox, Chrome, Opera, Safari
		hr2 = new XMLHttpRequest();
	} else if (window.ActiveXObject) {
		//code for IE6, IE5
		hr2 = new ActiveXObject("Microsoft.XMLHTTP");
	}			
	else {
		throw new Error("Ajax is not supported by this browser");
		alert("Ajax is not supported by this browser"); 
	}		
	var url2 = "search.ajax.faculty.php";
    hr2.open("POST", url2, true);
    // Set content type header information for sending url encoded variables in the request
    hr2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    // Access the onreadystatechange event for the XMLHttpRequest object
    hr2.onreadystatechange = function() {
	    if(hr2.readyState == 4 && hr2.status == 200) {
		    var return_data = hr2.responseText;
			document.getElementById("Faculty_Search").innerHTML = hr2.responseText;
	    }
    }
    // Send the data to PHP now... and wait for response to update the status div
    hr2.send(vars); // Actually execute the request
		
	var hr3;
	if (window.XMLHttpRequest) {
		//code for IE7+, Firefox, Chrome, Opera, Safari
		hr3 = new XMLHttpRequest();
	} else if (window.ActiveXObject) {
		//code for IE6, IE5
		hr3 = new ActiveXObject("Microsoft.XMLHTTP");
	}			
	else {
		throw new Error("Ajax is not supported by this browser");
		alert("Ajax is not supported by this browser"); 
	}	
	var url3 = "search.ajax.mentor.php";
    hr3.open("POST", url3, true);
    // Set content type header information for sending url encoded variables in the request
    hr3.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    // Access the onreadystatechange event for the XMLHttpRequest object
    hr3.onreadystatechange = function() {
	    if(hr3.readyState == 4 && hr3.status == 200) {
		    var return_data = hr3.responseText;
			document.getElementById("Mentor_Search").innerHTML = hr3.responseText;
	    }
    }
    // Send the data to PHP now... and wait for response to update the status div
    hr3.send(vars); // Actually execute the request
	
	
    //form.submit();
    return true;
}

function InformationSelectSession(form, Selector) {
     // Check each field has a value
    if (Selector.value == '') {
        alert('ابتدا از به روز رسانی استفاده کنید و پس از انتخاب یکی از داده های موجود دوباره اقدام کنید!');
        return false;
    }
    //alert(Selector.value);
    //re = /^\w+$/; 
	re= /^[0123456789]+$/;
    if(!re.test(Selector.value)) { 
        alert("لطفا از طریق صحیح بوسیله ی سیستم نشا گزینه ی مورد نظر را انتخا کنید!"); 
        form.Selector.focus();
        return false; 
    }

	var hr;
	//var xmlhttp;
	if (window.XMLHttpRequest) {
		//code for IE7+, Firefox, Chrome, Opera, Safari
		hr = new XMLHttpRequest();
	} else if (window.ActiveXObject) {
		//code for IE6, IE5
		hr = new ActiveXObject("Microsoft.XMLHTTP");
	}			
	else {
		throw new Error("Ajax is not supported by this browser");
		alert("Ajax is not supported by this browser"); 
	}			
    // Create some variables we need to send to our PHP file
    var url = "update.ajax.select.session.php";
    var vars = 	'Selector='+ Selector.value;
    hr.open("POST", url, true);
    // Set content type header information for sending url encoded variables in the request
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    // Access the onreadystatechange event for the XMLHttpRequest object
    hr.onreadystatechange = function() {
	    if(hr.readyState == 4 && hr.status == 200) {
		    var return_data = hr.responseText;
			document.getElementById("UpdateFormSession").innerHTML = hr.responseText;
	    }
    }
    // Send the data to PHP now... and wait for response to update the status div
    hr.send(vars); // Actually execute the request
    //form.submit();
    return true;
}
//---------------------------UPDATE PART
function regformUPDATESession(form, SessionSubject, SessionPlace, SessionDate, SessionType, SessionHours, SessionReport,SessionSID) {
	

     // Check each field has a value
    if (SessionSubject.value == ''         || 
          SessionPlace.value == ''     || 
          SessionDate.value == ''  || 
          SessionType.value == ''  || 
          SessionHours.value == ''  || 
          SessionReport.value == ''|| 
          SessionSID.value == '') {
 
        alert('باید تمام اطلاعات خواسته شده را با دقت وارد نمایید!');
        return false;
    }
    alert(SessionSID);

    // Check the SessionSubject
 
    //re = /^\w+$/; 
	re= /^[\u0600-\u06FF\uFB8A\u067E\u0686\u06AF 0123456789]+$/;
    if(!re.test(form.SessionSubject.value)) { 
        alert("موضوع جلسه فقط می تواند شامل حروف و اعداد فارسی باشد!"); 
        form.SessionSubject.focus();
        return false; 
    }
	
 	re= /^[\u0600-\u06FF\uFB8A\u067E\u0686\u06AF 0123456789]+$/;
    if(!re.test(form.SessionPlace.value)) { 
        alert("محل نشست فقط می تواند شامل حروف و اعداد فارسی باشد!"); 
        form.SessionPlace.focus();
        return false; 
    }
 
    // Check that the SessionDate is sufficiently long (min 10 chars)
    // The check is duplicated below, but this is included to give more
    // specific guidance to the user
	re=/(\d{2})\/(\d{2})\/(\d{4})$/;
	if(!re.test(form.SessionDate.value)){         
        alert('تاریخ را به درستی بوسیله ی ابزار انتخاب تاریخ وارد کنید!');
        form.SessionDate.focus();
        return false;
	}
    

     // Check that the SessionType is between 1 to 6
    if (SessionType.value <  1 || SessionType.value >  6) {
        alert('ورودی غیر مجاز در نوع نشست!');
        form.SessionType.focus();
        return false;
    }
  	re= /^[1234567890]+$/;
    if(!re.test(form.SessionHours.value)) { 
        alert("در ورودی مدت برگزاری لطفا فقط از اعداد استفاده کنید!"); 
        form.SessionHours.focus();
        return false; 
    }
	
  	re= /^[1234567890]+$/;
    if(!re.test(form.SessionSID.value)) { 
        alert("لطفا به درستی عمل کنید و از سیستم نشا استفاده کنید!"); 
        form.SessionSID.focus();
        return false; 
    }

  	re= /^[\u0600-\u06FF\uFB8A\u067E\u0686\u06AF a-z0-9-~+.؟?#=!&;,/:%@$\|*()]+$/;
    if(!re.test(form.SessionReport.value)) { 
        alert("صورت جلسه فقط می تواند شامل اعداد و حروف فارسی باشد!"); 
        form.SessionReport.focus();
        return false; 
    }
	// Convert to Georgian Date for saving in DB
	var GD = document.createElement("input");
	form.appendChild(GD);
	GD.name = "GD";
	GD.type = "hidden";
	GD.value = dateGeorg;
	//window.alert(GD);
	//window.alert(dateGeorg);
    // Finally submit the form. 
	
	
	//var hr = new XMLHttpRequest();
	var hr2;
	//var xmlhttp;
	if (window.XMLHttpRequest) {
		//code for IE7+, Firefox, Chrome, Opera, Safari
		hr2 = new XMLHttpRequest();
	} else if (window.ActiveXObject) {
		//code for IE6, IE5
		hr2 = new ActiveXObject("Microsoft.XMLHTTP");
	}			
	else {
		throw new Error("Ajax is not supported by this browser");
	}			
    // Create some variables we need to send to our PHP file
    var url = "update.ajax.reg.php";
    var vars = 	'GD='+ GD.value + '&SessionSubject='+ SessionSubject.value + '&SessionPlace='+ SessionPlace.value + '&SessionDate='+ SessionDate.value + '&SessionType='+ SessionType.value + '&SessionHours='+ SessionHours.value +'&SessionReport=' + SessionReport.value +'&SessionSID=' + SessionSID.value;
    hr2.open("POST", url, true);
    // Set content type header information for sending url encoded variables in the request
    hr2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    // Access the onreadystatechange event for the XMLHttpRequest object
    hr2.onreadystatechange = function() {
	    if(hr2.readyState == 4 && hr2.status == 200) {
		    var return_data = hr2.responseText;
			document.getElementById("Error_Response").innerHTML = hr2.responseText;
	    }
    }
    // Send the data to PHP now... and wait for response to update the status div
    hr2.send(vars); // Actually execute the request
	
	
    //form.submit();
    return true;
}
