# Creating a theme

1: Create a CSS file inside of the /static/css folder

2: Using the list below, edit specific elements using their div class selectors.

3: Edit the $themeChoice to be the name of your css file (without the '.css' at the end)

4: Your theme is now live!


## CSS Class Selectors

The following will be all of the class selectors followed by how they are used in the Light Theme.

##### .n-navbar-theme
Highest div of the navigation menu

    .n-navbar-theme {
        font-family: 'Nunito', sans-serif;
        font-size: 1.1rem;
        line-height: 1.6rem;
        letter-spacing: 0.02rem;
        font-weight: 400;
        background-color: #ffffff;
        padding:1.5% 4%;
    }
    
##### .n-logo-theme
Used to color the text next to the logo

    .n-logo-theme {
        color: #0f1121;
    }
       
##### .n-pullUp:hover
On-Hover effects for the menu items

    .n-pullUp:hover {
        color: #ffffff;
        width: 100%;
        height: 100%;
        content: '';
        background: #0f1121;
        opacity: 1;
        transition: all 0s;
    }
              
##### .n-text-theme
Text color for text inside of Node Cards + Address Field

    .n-text-theme {
        color: #0f1121!important;
    }

##### .n-h2-theme
Modifies the h2 divs

    .n-h2-theme {
        font-family: 'Nunito', sans-serif;
        font-size: 2.5rem;
        line-height: 2.9rem;
        font-weight: 400;
        max-width: 930px;
    }
       
##### .n-h3-theme
Modifies the h3 divs

    .n-h3-theme {
        font-family: 'Nunito', sans-serif;
        font-size: 1.4rem;
        font-weight: 400;
        max-width: 930px;
    }
        
##### .n-p-theme
Modifies the p divs

    .n-p-theme {
        font-family: 'Nunito', sans-serif;
        font-size: 0.9rem;
        line-height: 1.6rem;
        letter-spacing: 0.02em;
    }
    
##### .n-address-theme
Modifies the address input field

    .n-address-theme {
        background-color: #ffffff!important;
        display: block;
        width: 100%;
        padding: .375rem .75rem;
        font-size: 1rem;
        line-height: 1.5;
        background-clip: padding-box;
        border: 1px solid #000034;
        border-radius: 0rem;
        transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    }
    
##### .n-card-theme
Modifies the Nano Info Cards

    .n-card-theme {
        background-color: #fff;
    }
    
    
## Tips

- Add a padding-top to the 'body' element in your css file, to properly show CMC widget + Nano Logo

- Make sure you include your own logo images in static/img/ - the header logo image is nano-mark-<themename> and the logo to the left of the CMC Ticker Widget is nano-full-<themename>

- Need help? Ask icarus#2597 on discord.
