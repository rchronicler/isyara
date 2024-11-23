// Alert if file size is too large
function validateFileSize(input) {
    const file = input.files[0];
    const maxSize = 40 * 1024 * 1024; // 40 MB in bytes
    if (file && file.size > maxSize) {
        alert('File is too large. Maximum file size is 40 MB.');
        input.value = ''; // Clear the input
    }
}
window.validateFileSize = validateFileSize;

// For the category guide accordion
window.addEventListener('DOMContentLoaded', (event) => {
    const accordionToggle = document.getElementById('accordion-toggle');
    const accordionArrow = document.getElementById('accordion-arrow');

    if (accordionToggle) {
        accordionToggle.addEventListener('click', function () {
            const content = document.getElementById('accordion-content');
            const isHidden = content.classList.contains('hidden');

            if (isHidden) {
                content.classList.remove('hidden');
                this.setAttribute('aria-expanded', 'true');
                accordionArrow.innerHTML = '<i class=\'bx bxs-minus-square\' ></i>'; // Minus symbol (−)
            } else {
                content.classList.add('hidden');
                this.setAttribute('aria-expanded', 'false');
                accordionArrow.innerHTML = '<i class=\'bx bxs-plus-square\' ></i>'; // Plus symbol (+)
            }
        });
    }
});
