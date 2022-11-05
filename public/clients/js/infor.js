document.querySelector(".detail_list table").style.display = "table";
document.querySelector(".detail_list .content_film").style.display = "none";
document.getElementById("detail_list").style.height 
    = document.getElementById("poster_id").offsetHeight + "px";

window.onresize = ()=> {
    document.getElementById("detail_list").style.height 
    = document.getElementById("poster_id").offsetHeight + "px";
}

const nameButtonContent = () => {
    return document.getElementById("btn_detail_film").innerHTML 
        = (document.querySelector(".detail_list table")
            .style.display === "none")
                ? "Chi tiết phim"
                : "Nội dung phim"; 
}
nameButtonContent();

const handleDetailFilm = () => {
    const a = document.querySelector(".detail_list table")
    const b = document.querySelector(".detail_list .content_film")

    if(a.style.display === "none"){
        a.style.display = "table"
        b.style.display = "none"
        nameButtonContent();
    }else {
        b.style.display = "table"
        a.style.display = "none"
        nameButtonContent();
    }
}