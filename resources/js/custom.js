// Alert if file size is too large
function validateFileSize(input) {
    const maxSize = 40 * 1024 * 1024; // 40 MB in bytes
    const file = input.files[0];

    if (file && file.size > maxSize) {
        alert(`File "${file.name}" is too large. Maximum file size is 40 MB.`);
        input.value = ''; // Clear the input
    } else if (file) {
        console.log(`File "${file.name}" is valid.`);
    }
}

window.validateFileSize = validateFileSize;

// For the category guide accordion
window.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.answer-btn').forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault();

            const form = this.closest('form');
            const formData = new FormData(form);

            fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    const feedbackDiv = document.querySelector('#feedback-container');
                    feedbackDiv.classList.remove('hidden');

                    if (data.status === 'correct') {
                        feedbackDiv.innerHTML = `<div class="correct-answer bg-green-100 text-green-700 p-4 rounded-lg">
                    <p class="font-medium">${data.message}</p>
                </div>`;
                    } else {
                        feedbackDiv.innerHTML = `<div class="wrong-answer bg-red-100 text-red-700 p-4 rounded-lg">
                    <p class="font-medium">${data.message}</p>
                </div>`;
                    }
                });
        });
    });

    document.querySelectorAll('.submission-item').forEach(item => {
        item.addEventListener('click', function () {
            // Get current spotlight data
            const spotlightFrame = document.getElementById('spotlight-iframe');
            const spotlightTitle = document.getElementById('spotlight-title');
            const spotlightDesc = document.getElementById('spotlight-description');
            const spotlightCategory = document.querySelector('#spotlight-submission .text-gray-500 span');

            // Store current spotlight data
            const oldVideoUrl = spotlightFrame.src;
            const oldTitle = spotlightTitle.textContent;
            const oldDesc = spotlightDesc.textContent;
            const oldCategory = spotlightCategory.textContent;

            // Update spotlight with clicked item data
            spotlightFrame.src = this.dataset.videoUrl;
            spotlightTitle.textContent = this.dataset.title;
            spotlightDesc.textContent = this.dataset.description;
            spotlightCategory.textContent = this.dataset.category;

            // Update clicked item with old spotlight data
            this.dataset.videoUrl = oldVideoUrl;
            this.dataset.title = oldTitle;
            this.dataset.description = oldDesc;
            this.dataset.category = oldCategory;

            // Update the visible content of the clicked item
            this.querySelector('h3').textContent = oldTitle;
            this.querySelector('span').textContent = oldCategory;

            // Optional: Scroll to spotlight on mobile
            if (window.innerWidth < 768) {
                document.getElementById('spotlight-submission').scrollIntoView({behavior: 'smooth'});
            }
        });
    });

    // Accordion
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

    // Search bar
    const searchInput = document.querySelector('#search');
    const resultsDiv = document.querySelector('#results');

    if (searchInput && resultsDiv) {
        const adjustResultsBox = () => {
            const rect = searchInput.getBoundingClientRect();
            resultsDiv.style.width = `${rect.width}px`;
            resultsDiv.style.top = `${rect.bottom + window.scrollY}px`;
            resultsDiv.style.left = `${rect.left + window.scrollX}px`;
        };

        // Adjust results box on page load and window resize
        adjustResultsBox();
        window.addEventListener('resize', adjustResultsBox);

        // Show search results dynamically
        searchInput.addEventListener('input', async () => {
            const query = searchInput.value.trim();

            if (!query) {
                resultsDiv.innerHTML = '';
                resultsDiv.classList.add('hidden');
                return;
            }

            try {
                const response = await fetch(`/search?q=${encodeURIComponent(query)}`);
                const results = await response.json();

                // Render results
                if (results.length > 0) {
                    // Add results count at the top
                    resultsDiv.innerHTML = `
                <p class="text-teal-800 font-bold mb-4">
                    ${results.length} result${results.length > 1 ? 's' : ''} found
                </p>
                ${results
                        .map(
                            (result) =>
                                `<a href="/dictionary/${result.entry_id}" class="block mb-8 hover:bg-gray-100 transition-colors duration-200 rounded-lg">
                <div>
                    <h3 class="text-center font-bold text-lg text-teal-800 mb-4">${result.title}</h3>
                    <div class="flex justify-center mb-4">
                        <video controls class="w-48 aspect-video rounded-lg border-2 border-teal-800 shadow-lg">
                            <source src="${result.video_url}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                    <hr class="border-t border-gray-300">
                </div>
            </a>`
                        )
                        .join('')}
            `;
                    resultsDiv.classList.remove('hidden');
                } else {
                    resultsDiv.innerHTML = '<p class="text-gray-500">No results found.</p>';
                    resultsDiv.classList.remove('hidden');
                }
            } catch (error) {
                resultsDiv.innerHTML = '<p class="text-red-500">An error occurred while fetching results.</p>';
                resultsDiv.classList.remove('hidden');
                console.error('Error fetching search results:', error);
            }
        });

        // Close results when clicking outside
        document.addEventListener('click', (event) => {
            if (!resultsDiv.contains(event.target) && !searchInput.contains(event.target)) {
                resultsDiv.classList.add('hidden');
            }
        });

        // Carousel
        const carousel = document.getElementById('carousel');
        const scrollLeftButton = document.getElementById('scroll-left');
        const scrollRightButton = document.getElementById('scroll-right');

        const scrollAmount = 300; // Adjust for scroll distance

        const scrollCarousel = (direction) => {
            const targetScroll = direction === 'left'
                ? carousel.scrollLeft - scrollAmount
                : carousel.scrollLeft + scrollAmount;

            // Use smooth scrolling behavior
            carousel.scrollTo({
                left: targetScroll,
                behavior: 'smooth', // Enables smooth manual-like scrolling
            });
        };

        scrollLeftButton.addEventListener('click', () => scrollCarousel('left'));
        scrollRightButton.addEventListener('click', () => scrollCarousel('right'));
    }
});
