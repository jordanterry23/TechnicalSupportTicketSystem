class AlertBox
{
    wrapper = new Array();

    constructor(message, style)
    {
        this.message = message;
        this.style = style;
        this.alertPlaceholder = document.getElementById('alertBox');   
        if(this.alertPlaceholder)
        {
            // console.log("alert box found");
            this.alertPlaceholder.innerHTML = [
                '<div class="alert alert-'+ this.style + ' role="alert"',
                '   <div>'+ this.message + '</div>',
                '</div>'
            ].join('');
            //this.alertPlaceholder.append(this.wrapper);
        }
        else
        {
            console.log("ERROR: Can't find alert box.");
        }
    }

    show()
    {
        this.alertPlaceholder.style.display="block";
    }

    hide()
    {
        this.alertPlaceholder.style.display="none";
    }

    append(msg)
    {
        this.message += "</br>"+msg;
    }

}