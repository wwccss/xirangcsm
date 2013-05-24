/**
 * Create link. 
 * 
 * @param  string $moduleName 
 * @param  string $methodName 
 * @param  string $vars 
 * @param  string $viewType 
 * @access public
 * @return string
 */
function createLink(moduleName, methodName, vars, viewType)
{
    if(!viewType) viewType = config.defaultView;
    if(vars)
    {
        vars = vars.split('&');
        for(i = 0; i < vars.length; i ++) vars[i] = vars[i].split('=');
    }
    if(config.requestType == 'PATH_INFO')
    {
        link = config.webRoot + moduleName + config.requestFix + methodName;
        if(vars)
        {
            if(config.pathType == "full")
            {
                for(i = 0; i < vars.length; i ++) link += config.requestFix + vars[i][0] + config.requestFix + vars[i][1];
            }
            else
            {
                for(i = 0; i < vars.length; i ++) link += config.requestFix + vars[i][1];
            }
        }
        link += '.' + viewType;
    }
    else
    {
        link = config.router + '?' + config.moduleVar + '=' + moduleName + '&' + config.methodVar + '=' + methodName + '&' + config.viewVar + '=' + viewType;
        if(vars) for(i = 0; i < vars.length; i ++) link += '&' + vars[i][0] + '=' + vars[i][1];
    }
    return link;
}

/**
 * Highlight the menu for front pages.
 * 
 * @access public
 * @return void
 */
function highlightFrontMenu()
{
    activeMenu = methodName + 'Menu';
    if(methodName == 'view' || methodName == 'edit') activeMenu = 'browseMenu';   // request-view, request-edit same as the browse page.
    $('#' + activeMenu).addClass('active');
}

/**
 * Set the titile of all objects which class is .nobr.
 * 
 * @access public
 * @return void
 */
function setNowrapObjTitle()
{
    $('.nobr').each(function (i) 
    {
        if($.browser.mozilla) 
        {
            this.title = this.textContent;
        }
        else
        {
            this.title = this.innerText;
        }
    })
}

/**
 * Set the ping url.
 * 
 * @access public
 * @return void
 */
function setPing()
{
    $('#hiddenwin').attr('src', createLink('misc', 'ping'));
}

/**
 * Set required fields, add star class to them.
 * 
 * @access public
 * @return void
 */
function setRequiredFields()
{
    if(!config.requiredFields) return false;
    requiredFields = config.requiredFields.split(',');
    for(i = 0; i < requiredFields.length; i++)
    {
        $('#' + requiredFields[i]).after('<span class="star"> * </span>');
    }
}

/**
 * Set the css of the iframe.
 * 
 * @param  string $color 
 * @access public
 * @return void
 */
function setDebugWin(color)
{  
    if($.browser.msie && $('.debugwin').size() == 1)
    {
        var debugWin = $(".debugwin")[0].contentWindow.document;
        $("body", debugWin).append("<style>body{background:" + color + "}</style>");
    }
}

/**
 * Disable the submit button when submit form.
 * 
 * @access public
 * @return void
 */
function setForm()
{
    var formClicked = false;
    $('form').submit(function()
    {
        submitObj   = $(this).find(':submit');
        if($(submitObj).size() == 1)
        {
            submitLabel = $(submitObj).html();
            $(submitObj).html(config.submitting);
            $(submitObj).attr('disabled', 'disabled');
            formClicked = true;
        }
    });

    $("body").click(function()
    {
        if(formClicked)
        {
            $(submitObj).removeAttr('disabled');
            $(submitObj).html(submitLabel);
        }
        formClicked = false;
    });
}

/**
 * Set the max with of image.
 * 
 * @access public
 * @return void
 */
function setImageSize()
{
    bodyWidth = $('body').width();
    maxWidth = bodyWidth - 420; // The side bar's width is 336, and add some margins.
    $('.content image').each(function()
    {
        if($(this).width() > maxWidth) $(this).attr('width', maxWidth);
    });
}

/**
 * add one option of a select to another select. 
 * 
 * @param  string $SelectID 
 * @param  string $TargetID 
 * @access public
 * @return void
 */
function addItem(SelectID,TargetID)
{
    ItemList = document.getElementById(SelectID);
    Target   = document.getElementById(TargetID);
    for(var x = 0; x < ItemList.length; x++)
    {
        var opt = ItemList.options[x];
        if (opt.selected)
        {
            flag = true;
            for (var y=0;y<Target.length;y++)
            {
                var myopt = Target.options[y];
                if (myopt.value == opt.value)
                {
                    flag = false;
                }
            }
            if(flag)
            {
                Target.options[Target.options.length] = new Option(opt.text, opt.value, 0, 0);
            }
        }
    }
}

/**
 * Remove one selected option from a select.
 * 
 * @param  string $SelectID 
 * @access public
 * @return void
 */
function delItem(SelectID)
{
    ItemList = document.getElementById(SelectID);
    for(var x=ItemList.length-1;x>=0;x--)
    {
        var opt = ItemList.options[x];
        if (opt.selected)
        {
            ItemList.options[x] = null;
        }
    }
}

/**
 * move one selected option up from a select. 
 * 
 * @param  string $SelectID 
 * @access public
 * @return void
 */
function upItem(SelectID)
{
    ItemList = document.getElementById(SelectID);
    for(var x=1;x<ItemList.length;x++)
    {
        var opt = ItemList.options[x];
        if(opt.selected)
        {
            tmpUpValue = ItemList.options[x-1].value;
            tmpUpText  = ItemList.options[x-1].text;
            ItemList.options[x-1].value = opt.value;
            ItemList.options[x-1].text  = opt.text;
            ItemList.options[x].value = tmpUpValue;
            ItemList.options[x].text  = tmpUpText;
            ItemList.options[x-1].selected = true;
            ItemList.options[x].selected = false;
            break;
        }
    }
}

/**
 * move one selected option down from a select. 
 * 
 * @param  string $SelectID 
 * @access public
 * @return void
 */
function downItem(SelectID)
{
    ItemList = document.getElementById(SelectID);
    for(var x=0;x<ItemList.length;x++)
    {
        var opt = ItemList.options[x];
        if(opt.selected)
        {
            tmpUpValue = ItemList.options[x+1].value;
            tmpUpText  = ItemList.options[x+1].text;
            ItemList.options[x+1].value = opt.value;
            ItemList.options[x+1].text  = opt.text;
            ItemList.options[x].value = tmpUpValue;
            ItemList.options[x].text  = tmpUpText;
            ItemList.options[x+1].selected = true;
            ItemList.options[x].selected = false;
            break;
        }
    }
}

/**
 * select all items of a select. 
 * 
 * @param  string $SelectID 
 * @access public
 * @return void
 */
function selectItem(SelectID)
{
    ItemList = document.getElementById(SelectID);
    for(var x=ItemList.length-1;x>=0;x--)
    {
        var opt = ItemList.options[x];
        opt.selected = true;
    }
}

/**
 * Show the search or reduction the style. 
 * 
 * @access public
 * @return void
 */
function togglesearch()
{
    $("#bysearchTab").toggle(function()
    {
        $('#' + browseType).removeClass('active');
        $('#bysearchTab').addClass('active');
        $('#queryBox').removeClass('hidden');
    },
    function()
    {
        $('#' + browseType).addClass('active');
        $('#bysearchTab').removeClass('active');
        $('#queryBox').addClass('hidden');
    });
}

/* Ping the server every some minutes to keep the session. */
needPing = config.router.indexOf('admin.php') < 0 ? false : true;

/* When body's ready, execute these. */
$(document).ready(function() 
{
    if(config.router.indexOf('index.php') >= 0) highlightFrontMenu(); // only run in front.
    setNowrapObjTitle();
    setRequiredFields();
    setForm();
    togglesearch();
    if(needPing) setTimeout('setPing()', 1000 * 60 * 5);  // After 5 minutes, begin ping.
});
