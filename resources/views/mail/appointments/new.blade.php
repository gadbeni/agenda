<!DOCTYPE html>
<html lang="es" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <meta charset="utf-8"> <!-- utf-8 works for most cases -->
    <meta name="viewport" content="width=device-width"> <!-- Forcing initial-scale shouldn't be necessary -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Use the latest (edge) version of IE rendering engine -->
    <meta name="x-apple-disable-message-reformatting">  <!-- Disable auto-scale in iOS 10 Mail entirely -->
    <title>Nuevo evento</title> <!-- The title tag shows in email notifications, like Android 4.4. -->

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet">

    <!-- CSS Reset : BEGIN -->
    <style>

        /* What it does: Remove spaces around the email design added by some email clients. */
        /* Beware: It can remove the padding / margin and add a background color to the compose a reply window. */
        html,
        body {
            margin: 0 auto !important;
            padding: 0 !important;
            height: 100% !important;
            width: 100% !important;
            background: #f1f1f1;
        }

        /* What it does: Stops email clients resizing small text. */
        * {
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
        }

        /* What it does: Centers email on Android 4.4 */
        div[style*="margin: 16px 0"] {
            margin: 0 !important;
        }

        /* What it does: Stops Outlook from adding extra spacing to tables. */
        table,
        td {
            mso-table-lspace: 0pt !important;
            mso-table-rspace: 0pt !important;
        }

        /* What it does: Fixes webkit padding issue. */
        table {
            border-spacing: 0 !important;
            border-collapse: collapse !important;
            table-layout: fixed !important;
            margin: 0 auto !important;
        }

        /* What it does: Uses a better rendering method when resizing images in IE. */
        img {
            -ms-interpolation-mode:bicubic;
        }

        /* What it does: Prevents Windows 10 Mail from underlining links despite inline CSS. Styles for underlined links should be inline. */
        a {
            text-decoration: none;
        }

        /* What it does: A work-around for email clients meddling in triggered links. */
        *[x-apple-data-detectors],  /* iOS */
        .unstyle-auto-detected-links *,
        .aBn {
            border-bottom: 0 !important;
            cursor: default !important;
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }

        /* What it does: Prevents Gmail from displaying a download button on large, non-linked images. */
        .a6S {
            display: none !important;
            opacity: 0.01 !important;
        }

        /* What it does: Prevents Gmail from changing the text color in conversation threads. */
        .im {
            color: inherit !important;
        }

        /* If the above doesn't work, add a .g-img class to any image in question. */
        img.g-img + div {
            display: none !important;
        }

        /* What it does: Removes right gutter in Gmail iOS app: https://github.com/TedGoas/Cerberus/issues/89  */
        /* Create one of these media queries for each additional viewport size you'd like to fix */

        /* iPhone 4, 4S, 5, 5S, 5C, and 5SE */
        @media only screen and (min-device-width: 320px) and (max-device-width: 374px) {
            u ~ div .email-container {
                min-width: 320px !important;
            }
        }
        /* iPhone 6, 6S, 7, 8, and X */
        @media only screen and (min-device-width: 375px) and (max-device-width: 413px) {
            u ~ div .email-container {
                min-width: 375px !important;
            }
        }
        /* iPhone 6+, 7+, and 8+ */
        @media only screen and (min-device-width: 414px) {
            u ~ div .email-container {
                min-width: 414px !important;
            }
        }

    </style>

    <!-- CSS Reset : END -->

    <!-- Progressive Enhancements : BEGIN -->
    <style>

        /*BUTTON*/

        body{
            font-family: 'Lato', sans-serif;
            font-weight: 400;
            font-size: 15px;
            line-height: 1.8;
            color: rgba(0,0,0,.4);
        }
    </style>

</head>

<body width="100%" style="margin: 0; padding: 0px !important; mso-line-height-rule: exactly; background-color: #f1f1f1;">
	<center style="width: 100%; background-color: #f1f1f1;">
    <div style="display: none; font-size: 1px;max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden; mso-hide: all; font-family: sans-serif;">
      &zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;
    </div>
    <div style="max-width: 600px; margin: 0 auto;" class="email-container">
    	<!-- BEGIN BODY -->
      <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
      	<tr>
          <td valign="top" style="padding: 1em 2.5em 0 2.5em; background: {{ env('APP_PRIMARY_COLOR') }}">
          	<table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
          		<tr>
          			<td class="logo" style="text-align: center;">
			            <h1 style="font-family: 'Lato', sans-serif; color: #000000; margin-top: 0; font-weight: 400; margin: 0; padding-bottom: 20px"><a href="#" style="color: #fff; font-size: 24px; font-weight: 700; font-family: 'Lato', sans-serif;">Nuevo evento asignado</a></h1>
			          </td>
          		</tr>
          	</table>
          </td>
	      </tr><!-- end tr -->
	      <tr>
          {{-- <td valign="middle" class="hero bg_white" style="padding: 3em 0 2em 0;">
            <img src="images/email.png" alt="" style="width: 300px; max-width: 600px; height: auto; margin: auto; display: block;">
          </td> --}}
	      </tr><!-- end tr -->
				<tr>
          <td valign="middle" style="padding: 2em 0 4em 0; background: #ffffff;position: relative; z-index: 0;">
            <table>
            	<tr>
            		<td>
            			<div class="text" style="padding: 0 2.5em; text-align: center;">
            				<h2 style="font-family: 'Lato', sans-serif; color: #000000; margin-top: 0; font-weight: 400;">{{ $topic }}</h2>
            				<h4 style="font-family: 'Lato', sans-serif; color: #000000; margin-top: 0; font-weight: 400; text-align: justify;">{{ $description }}</h4>
                            <div style="text-align: left;">
                                <h3 style="font-family: 'Lato', sans-serif; color: #000000; margin-top: 0; font-weight: 400;">Detalles</h3>
                                <table width="100%" cellpadding="5">
                                    <tr>
                                        <td style="font-weight: 500; font-size: 16px; color: rgb(143, 143, 143); max-width: 150px">Lugar</td>
                                        <td style="font-weight: 500; font-size: 18px; color: rgb(49, 49, 49)">{{ $place }}</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: 500; font-size: 16px; color: rgb(143, 143, 143); max-width: 150px">Solicitante</td>
                                        <td style="font-weight: 500; font-size: 18px; color: rgb(49, 49, 49)">{{ $applicant }}</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: 500; font-size: 16px; color: rgb(143, 143, 143); max-width: 150px">Fecha</td>
                                        <td style="font-weight: 500; font-size: 18px; color: rgb(49, 49, 49)">{{ $date }}</td>
                                    </tr>
                                </table>
                                <br><br>
                            </div>
            				<p><a href="#" class="btn" style="padding: 10px 15px; display: inline-block;border-radius: 5px; background: {{ env('APP_PRIMARY_COLOR') }}; color: #ffffff;" >Ver calendario</a></p>
            			</div>
            		</td>
            	</tr>
            </table>
          </td>
	      </tr><!-- end tr -->
      <!-- 1 Column Text + Button : END -->
      </table>
      <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
      	<tr>
          <td valign="middle" class="email-section" style="background: #fafafa; padding:2.5em; border-top: 1px solid rgba(0,0,0,.05); color: rgba(0,0,0,.5);">
            <table>
            	<tr>
                <td valign="top" width="50%" style="padding-top: 20px;">
                  <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                    <tr>
                      <td style="text-align: left; padding-right: 10px;">
                      	<h3 class="heading" style="font-family: 'Lato', sans-serif; color: #000000; margin-top: 0; font-weight: 400; color: #000; font-size: 20px;">Acerca de </h3>
                      	<p>SYSADMIN es un sistema integrado para la administración del GADBENI.</p>
                      </td>
                    </tr>
                  </table>
                </td>
                <td valign="top" width="50%" style="padding-top: 20px;">
                  <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                    <tr>
                      <td style="text-align: left; padding-left: 5px; padding-right: 5px;">
                      	<h3 class="heading" style="font-family: 'Lato', sans-serif; color: #000000; margin-top: 0; font-weight: 400; color: #000; font-size: 20px;">Contacto</h3>
                      	    <ul style="margin: 0; padding: 0;">
                                <li style="list-style: none; margin-bottom: 10px;"><span class="text">Palza José Ballivian acera sur, Satísima Trinidad - Beni - Bolivia</span></li>
                                <li style="list-style: none; margin-bottom: 10px;"><span class="text">+59175199157</span></a></li>
                            </ul>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
          </td>
        </tr><!-- end: tr -->
        <tr>
          <td style="text-align: center; background: #fafafa;">
          	<p>Desarrollado por <a href="#" style="color: rgba(0,0,0,.8);"> Unidad de Desarrollo de Software</a></p>
          </td>
        </tr>
      </table>

    </div>
  </center>
</body>
</html>