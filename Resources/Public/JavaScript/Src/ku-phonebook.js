/**
 * Handle KU Persons events
 */
document.addEventListener('DOMContentLoaded', () => {
    'use strict';

    const input = document.getElementById('KuPersons');
    const reset = document.getElementById('reset');
    const results = document.getElementById('ku-phonebook-results');

    reset.addEventListener('click', () => {
        results.textContent = '';
        input.value = '';
        input.focus();
    });

});