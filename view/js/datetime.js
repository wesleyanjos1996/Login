function checkTime(i) {
    if (i < 10) i = '0' + i
    return i
}

function startDateTime() 
{
    const today = new Date()
    let h = today.getHours()
    let i = today.getMinutes()
    let s = today.getSeconds()
    let y = today.getFullYear()
    let m = today.getMonth()
    let d = today.getDate()

    switch (m) {
        case 0: m = 'Jan'; break;
        case 1: m = 'Fev'; break;
        case 2: m = 'Mar'; break;
        case 3: m = 'Abr'; break;
        case 4: m = 'Mai'; break;
        case 5: m = 'Jun'; break;
        case 6: m = 'Jul'; break;
        case 7: m = 'Ago'; break;
        case 8: m = 'Set'; break;
        case 9: m = 'Out'; break;
        case 10: m = 'Nov'; break;
        case 11: m = 'Dez'; break;
        default: m = ' - '; break;
    }

    i = checkTime(i)
    s = checkTime(s)
    document.querySelector('#today').innerHTML = `Data: ${d}/${m}/${y} Horário: ${h}:${i}:${s}`

    let t = setTimeout(function() {
        startDateTime()
    }, 500)
}

startDateTime()