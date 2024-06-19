document.addEventListener('DOMContentLoaded', function() {
    let page = 1;
    const videoContainer = document.getElementById('video-container');
    const scrollContainer = document.getElementById('scroll-container');

    const loadVideos = async () => {
        try {
            const response = await fetch(`/videos?page=${page}`);
            if (!response.ok) throw new Error('Network response was not ok');
            const videos = await response.json();

            videos.forEach(video => {
                const videoDiv = document.createElement('div');
                videoDiv.classList.add('bg-white', 'p-4', 'rounded', 'shadow-md', 'w-full', 'max-w-md');

                videoDiv.innerHTML = `
                    <h3 class="text-lg font-semibold">${video.name}</h3>
                    <p>${video.description}</p>
                    <div class="video-embed">
                        <iframe class="w-full h-96" src="${video.url}?autoplay=1&mute=1" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                    <p class="text-sm text-gray-600">Tag: ${video.tag}</p>
                `;

                videoContainer.appendChild(videoDiv);
            });

            if (videos.length > 0) {
                page++;
            }
        } catch (error) {
            console.error('Error fetching videos:', error);
        }
    };

    const handleScroll = () => {
        const { scrollTop, scrollHeight, clientHeight } = scrollContainer;

        if (scrollTop + clientHeight >= scrollHeight - 5) {
            loadVideos();
        }
    };

    scrollContainer.addEventListener('scroll', handleScroll);
    loadVideos();
});
