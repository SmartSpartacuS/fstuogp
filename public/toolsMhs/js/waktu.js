let tgl = $('#tgl').val()
let seles = $('#seles').val()
    // Set the date we're counting down to
let countDownDate = new Date(tgl + " " + seles).getTime();
// let countDownDate = new Date("2020-04-20 22:27:00").getTime();

// Update the count down every 1 second
let x = setInterval(function() {

    // Get today's date and time
    let now = new Date().getTime();

    // Find the distance between now and the count down date
    let distance = countDownDate - now;

    // Time calculations for days, hours, minutes and seconds
    let days = Math.floor(distance / (1000 * 60 * 60 * 24));
    let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    let seconds = Math.floor((distance % (1000 * 60)) / 1000);

    // Output the result in an element with id="demo"
    $("#countdown").html('Sisa Waktu : ' + minutes + ":" + seconds + "")
    $(".waktu_jawab").val(hours + ":" + minutes + ":" + seconds)
    console.log(distance)

    if (distance < 60000) {
        $("#countdown").css("color", "red", "font-weight", "bold");

    }
    // If the count down is over, write some text 
    if (distance < 999) {
        alertify.alert("Waktu Anda Telah Habis");
    }
    if (distance < 800) {
        clearInterval(x);
        $('#jawaban').submit()
    }
}, 1000);