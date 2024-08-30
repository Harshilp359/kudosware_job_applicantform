function validateForm() {
    let isValid = true;

    // Clear previous error messages
    document.getElementById('nameError').textContent = '';
    document.getElementById('emailError').textContent = '';
    document.getElementById('contactError').textContent = '';
    document.getElementById('ageError').textContent = '';
    document.getElementById('roleError').textContent = '';
    document.getElementById('resumeError').textContent = '';

    // Name validation
    const name = document.getElementById('name').value;
    if (name.trim() === '') {
        document.getElementById('nameError').textContent = 'Name is required.';
        isValid = false;
    }

    // Email validation
    const email = document.getElementById('email').value;
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(email)) {
        document.getElementById('emailError').textContent = 'Please enter a valid email address.';
        isValid = false;
    }

    // Contact validation
    const contact = document.getElementById('contact').value;
    if (contact.length !== 10 || isNaN(contact)) {
        document.getElementById('contactError').textContent = 'Contact number must be exactly 10 digits.';
        isValid = false;
    }

    // Age validation
    const age = document.getElementById('age').value;
    if (age < 18) {
        document.getElementById('ageError').textContent = 'Age must be 18 or older.';
        isValid = false;
    }

    // Role validation
    const role = document.getElementById('role').value;
    if (role === '') {
        document.getElementById('roleError').textContent = 'Please select a role.';
        isValid = false;
    }

    // Resume validation
    const resume = document.getElementById('resume').files[0];
    if (resume && resume.type !== 'application/pdf') {
        document.getElementById('resumeError').textContent = 'Resume must be a PDF file.';
        isValid = false;
    }

    return isValid;
}
