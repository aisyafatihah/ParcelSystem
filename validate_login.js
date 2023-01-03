const form = document.getElementById('form');
const id_user = document.getElementById('userID');
const pwd = document.getElementById('password');


form.addEventListener('submit', e => {
    // e.preventDefault();

    var isValid = validateInputs();
    if (!isValid) {
        e.preventDefault();
       return;
    }
});


const setError = (element, message) => {
    const inputControl = element.parentElement;
    const errorDisplay = inputControl.querySelector('.error');

    errorDisplay.innerText = message;
    inputControl.classList.add('error');
    inputControl.classList.remove('success')
}

const setSuccess = element => {
    const inputControl = element.parentElement;
    const errorDisplay = inputControl.querySelector('.error');

    errorDisplay.innerText = '';
    inputControl.classList.add('success');
    inputControl.classList.remove('error');
};

const validateInputs = () => {
    const passwordValue = password.value.trim();
    const idValue = id_user.value.trim();

    let jsonObj = {"pwdStatus":false, "idStatus":false
}; //initialize to all false at first


    if(passwordValue === '') {
        setError(pwd, 'Password is required');
    } else if (passwordValue.length < 8 ) {
        setError(pwd, 'Password must be at least 8 character.')
    } else {
        setSuccess(pwd);
        jsonObj['pwdStatus'] = true; //reassign to true
    }

    if(idValue === '') {
        setError(id_user, 'User ID is required');
    } else {
        setSuccess(id_user);
        jsonObj['idStatus'] = true; //reassign to true
    }

        //check validation
        var valuesArr = Object.values(jsonObj); 
        //create array from one level json object, after all validations and reassigment of booleans
        //initialize passCheckBool to initially true
        var passCheckBool = true;
        if(valuesArr.includes(false)){
            var passCheckBool = false;
        } //change passCheckBool to false if contains false element in valuesArr
        return passCheckBool;
};
