function testing(){
    alert('Test')
}

function checkInputAccount(){
    var x = document.forms['NewAccount']['username'].value
    var y = document.forms['NewAccount']['password'].value
    var z = document.forms['NewAccount']['repassword'].value
    var xx = document.forms['NewAccount']['admin'].value
    if (x == '') {
        alert('Please fill all fields');
        return false
    }
    if (y == '') {
        alert('Please fill all fields');
        return false
    }
    if (z == '') {
        alert('Please fill all fields');
        return false
    }
    if (xx == '') {
        alert('Please fill all fields');
        return false
    }
    if (y != z) {
        alert('Passwords must match');
        return false
    }
}

function checkInputFine(){
    var x = document.forms['NewFine']['amount'].value
    var y = document.forms['NewFine']['points'].value
    var z = document.forms['NewFine']['incident'].value
    if (x == '') {
        alert('Please fill all fields');
        return false
    }
    if (y == '') {
        alert('Please fill all fields');
        return false
    }
    if (z == '') {
        alert('Please fill all fields');
        return false
    }
}

function checkInputPeople(){
    var x = document.forms['PeopleLookup']['first'].value
    var y = document.forms['PeopleLookup']['last'].value
    var z = document.forms['PeopleLookup']['licence'].value
    if (x == '') {
        if (y == '') {
            if (z=='') {
                alert('At least one field must be filled')
                return false
            }
        }
    }
}

function checkInputVehicle(){
    var x = document.forms['VehicleLookup']['licence'].value
    if (x=='') {
        alert('Please enter a licence')
        return false
    }
}

function checkInputIncident() {
    var f = document.forms['Incident Entry']['vehicleid'].value
    var g = document.forms['Incident Entry']['offenceid'].value
    var h = document.forms['Incident Entry']['report'].value
    var i = document.forms['Incident Entry']['date'].value
    if (f=='') {
        alert('Please fill in all the required fields')
        return false
    }
    if (g=='') {
        alert('Please fill in all the required fields')
        return false
    }
    if (h=='') {
        alert('Please fill in all the required fields')
        return false
    }
    if (i=='') {
        alert('Please fill in all the required fields')
        return false
    }
}

function validatePassword(){
    var x = document.forms['passChange']['Password'].value
    var y = document.forms['passChange']['PasswordConfirm'].value

    if (x == '') {
        alert('Password must be filled out')
        return false
    }
    if  (y == '') {
        alert('Password must be filled out')
        return false
    }
    if (x==y) {
        alert('Password Changed')
        return true
    }
    else {
        alert('Passwords must match')
        return false
    }
}

function checkInputNewPerson() {
    var f = document.forms['PersonInput']['firstname'].value
    var g = document.forms['PersonInput']['lastname'].value
    var h = document.forms['PersonInput']['Address'].value
    var i = document.forms['PersonInput']['LicenceP'].value
    if (f=='') {
        alert('Please fill in all the required fields')
        return false
    }
    if (g=='') {
        alert('Please fill in all the required fields')
        return false
    }
    if (h=='') {
        alert('Please fill in all the required fields')
        return false
    }
    if (i=='') {
        alert('Please fill in all the required fields')
        return false
    }
}

function checkInputNewVehicle() {
    var a = document.forms['VehicleEntry']['type'].value
    var b = document.forms['VehicleEntry']['colour'].value
    var d = document.forms['VehicleEntry']['licence'].value
    if (a=='') {
        alert('Please fill in all the required fields')
        return false
    }
    if (b=='') {
        alert('Please fill in all the required fields')
        return false
    }
    if (c=='') {
        alert('Please fill in all the required fields')
        return false
    }
    if (d=='') {
        alert('Please fill in all the required fields')
        return false
    }
    if (e=='') {
        alert('An owner ID must be included')
        return false
    }
}

function wrongPass() {
    alert('Wrong Password')
}

function checkPass() {
    var a = document.forms['Login']['Username'].value
    var b = document.forms['Login']['Password'].value
    if (a=='') {
        alert('Please enter username');
        return false
    }
    if (b=='') {
        alert('Please enter password');
        return false
    }
}