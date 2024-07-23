//---------add hovered class to selected list item-----

let list=document.querySelectorAll(".navigation li");

function activeLink(){
    list.forEach((item)=>{
        item.classList.remove("hovered");
    });
    this.classList.add("hovered");
}

list.forEach(item=>item.addEventListener("click",activeLink))

//----------------Menu Toggle-----------------------
let toggle=document.querySelector(".toggle");
let navigation=document.querySelector(".navigation");
let main=document.querySelector(".main");

toggle.onclick=function(){
    navigation.classList.toggle("active");
    main.classList.toggle("active");
};




//-----------Navigation show/ hidden items-------------
function toggleVisibility(id) {
    var allDivs = ['div1', 'div2', 'div3','div4', 'div5', 'div6','div7','div8', 'div9'];
    allDivs.forEach(function(divId) {
        var element = document.getElementById(divId);
        if (divId === id) {
            element.style.display = 'block';
        } else {
            element.style.display = 'none';
        }
    });
}

// function toggleVisibility(id) {
//     var element = document.getElementById(id);
//     if (element.style.display === "none") {
//         element.style.display = "";
//     } else {
//         element.style.display = "none";
//     }
// }



        // Function to open the sign-out popup
        function openSignoutPopup() {
            document.getElementById('signoutPopup').style.display = 'block';
        }

        // Function to close the sign-out popup
        function closeSignoutPopup() {
            document.getElementById('signoutPopup').style.display = 'none';
        }

        // // Function to perform sign-out action
        // function signOut() {
        //     // Add your sign-out logic here
        //     // alert('Signed out successfully!'); 
        //     closeSignoutPopup(); // Close the popup after sign-out
        // }

        // Event listener to open the sign-out popup when the Google icon is clicked
        document.getElementById('userIcon').addEventListener('click', function() {
            openSignoutPopup();
        });








