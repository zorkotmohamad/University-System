document.addEventListener("DOMContentLoaded",function(){
    const hidden = document.querySelectorAll('.hidden');
    const options={
        root:null,
        rootMargin:'0px',
        threshold: .7
    }
    const observer = new IntersectionObserver(callback,options);
    hidden.forEach(function(element){
        observer.observe(element);
    });
    function callback(entries,observer){
        entries.forEach(function(entry){
            if(entry.isIntersecting){
                entry.target.classList.add('visibility');
                entry.target.classList.remove('hidden');
                observer.unobserve(entry.target);
            }
        });
    }
});