<!DOCTYPE html>
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<style type="text/css">    
    /* CLIENT-SPECIFIC STYLES */
    body, table, td, a { -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }
    table, td { mso-table-lspace: 0pt; mso-table-rspace: 0pt; }
    img { -ms-interpolation-mode: bicubic; }

    /* RESET STYLES */
    img { border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none; }
    table { border-collapse: collapse !important; }
    body { height: 100% !important; margin: 0 !important; padding: 0 !important; width: 100% !important; }

    /* iOS BLUE LINKS */
    a[x-apple-data-detectors] {
        color: inherit !important;
        text-decoration: none !important;
        font-size: inherit !important;
        font-family: inherit !important;
        font-weight: inherit !important;
        line-height: inherit !important;
    }
    
    /* MOBILE STYLES */
    @media screen and (max-width:600px){
        h1 {
            font-size: 32px !important;
            line-height: 32px !important;
        }
    }

    /* ANDROID CENTER FIX */
    div[style*="margin: 16px 0;"] { margin: 0 !important; }
</style>

<style type="text/css">

</style>
</head>
<body style="background-color: #f4f4f4; margin: 0 !important; padding: 0 !important;">

<!-- HIDDEN PREHEADER TEXT -->
<div style="display: none; font-size: 1px; color: #fefefe; line-height: 1px; font-family: Helvetica, Arial, sans-serif; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;">
    
</div>

<table border="0" cellpadding="0" cellspacing="0" width="100%">
    <!-- LOGO -->
    <tr>
        <td bgcolor="#f4f4f4" align="center">
 
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 90%" >
                <tr>
                    <td align="center" valign="top" style="padding: 40px 10px 40px 10px;">
                        <a href="#" target="_blank">
                            <img alt="Logo" src="{{ asset('assets/images/logo-black.png') }}" style="display: block; font-family: Helvetica, Arial, sans-serif; color: #ffffff; font-size: 18px;" border="0">
                        </a>
                    </td>
                </tr>
            </table>

        </td>
    </tr>
    <!-- HERO -->
    <tr>
        <td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;">
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 90%" >
                <tr>
                    <td bgcolor="#ffffff" align="left" valign="top" style="padding: 40px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #111111; font-family: Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; letter-spacing: 4px; line-height: 48px;">
                      <p style="font-size: 32px; font-weight: 600; margin: 0; letter-spacing: 0px;">
                        Hello {{ $first_name ?? '' }} {{ $last_name ?? '' }},
                      </p>
                    </td>
                </tr>
            </table>

        </td>
    </tr>
    <!-- COPY BLOCK -->
    <tr>
        <td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;">

            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 90%" >
              <!-- COPY -->
              <tr>
                <td bgcolor="#ffffff" align="left" style="padding: 0px 30px 10px 30px; color: #666666; font-family: Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;" >
                  <p style="margin: 0;">
                      Thank you very much for requesting a free trial of goodjob. We hope you will enjoy testing our field staff management software. Here's some important information to get you started:
                  </p>
                </td>
              </tr>
           
              <tr>
                <td bgcolor="#ffffff" align="left" style="padding: 0px 30px 10px 30px; color: #666666; font-family: Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;" >
                  <p style="margin: 0;">
                        Your goodjob login details
                        <br>
                        <strong>URL</strong>: <a href="{{ route('home.index') }}">{{ route('home.index') }}</a><br>
                        <strong>Username</strong>: <a href="{{ $email ?? '' }}">{{ $email ?? '' }}</a><br>
                        <strong>Password</strong>: {{ request()->password ?? '' }}
                  </p>
                  <p>
                      For your field workers to be able to receive, view and complete their jobs, they need to install the GoodJob mobile apps.
                  </p>
                  <p>
                      Don't hesitate to get in touch with us if you have any problems. We'd love to help!
                  </p>
                  <p>
                      All the best and hope you enjoy your goodjob experience!
                  </p>
                  <p>
                      Many thanks,
                  </p>
                </td>
              </tr>
              

            
              <tr>
                <td bgcolor="#ffffff" align="left" style="padding: 0px 30px 40px 30px; border-radius: 0px 0px 4px 4px; color: #666666; font-family: Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;" >
                  <p style="margin: 0;">The goodjob team</p>
                </td>
              </tr>
            </table>
         
        </td>
    </tr>
  
    </tr>
</table>
    
</body>
</html>
