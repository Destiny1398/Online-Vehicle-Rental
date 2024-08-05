document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById('insuranceForm');
    
    form.addEventListener('submit', function(event) {
        const name = document.getElementById('name').value;
        const email = document.getElementById('email').value;
        const plan = document.getElementById('plan').value;
        
        if (!validateName(name)) {
            alert('Please enter a valid name.');
            event.preventDefault();
        }
        
        if (!validateEmail(email)) {
            alert('Please enter a valid email address.');
            event.preventDefault();
        }

        if (!validatePlan(plan)) {
            alert('Please select an insurance plan.');
            event.preventDefault();
        }
    });
    
    function validateName(name) {
        return name.trim().length > 0;
    }
    
    function validateEmail(email) {
        const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        return emailPattern.test(email);
    }

    function validatePlan(plan) {
        return plan.trim().length > 0;
    }
});
