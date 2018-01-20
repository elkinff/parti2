<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Parti2</title>
  
  <style type="text/css">
    @import url(https://fonts.googleapis.com/css?family=Poppins:400,700,800);
    img {
      max-width: 600px;
      outline: none;
      text-decoration: none;
      -ms-interpolation-mode: bicubic;
    }

    a {
      text-decoration: none;
      border: 0;
      outline: none;
      color: #bbbbbb;
    }

    a img {
      border: none;
    }

    /* General styling */

    td, h1, h2, h3  {
      font-family: 'Poppins', sans-serif;
      font-weight: 400;
    }

    td {
      text-align: center;
      //border: 1px solid #ccc;
    }

    body {
      -webkit-font-smoothing:antialiased;
      -webkit-text-size-adjust:none;
      width: 100%;
      height: 100%;
      color: #37302d;
      background: #F5F6FA;
      font-size: 16px;
    }

     table {
      border-collapse: collapse !important;
    }

    .headline {
      color: #355C7D;
      font-size: 36px;
    }

    .force-full-width {
      width: 100% !important;
    }
  </style>

  <style type="text/css" media="screen">
      @media screen {
         /*Thanks Outlook 2013! http://goo.gl/XLxpyl*/
        td, h1, h2, h3 {
          font-family: 'Poppins', 'sans-serif' !important;
        }
      }
  </style>

  <style type="text/css" media="only screen and (max-width: 480px)">
    /* Mobile styles */
    @media only screen and (max-width: 480px) {

      table[class="w320"] {
        width: 320px !important;
      }


    }
  </style>

</head>

<body class="body" style="padding:0; margin:0; display:block; background:#F5F6FA; -webkit-text-size-adjust:none" bgcolor="#F5F6FA">

<table align="center" cellpadding="0" cellspacing="0" width="100%" height="100%">
  <tr>
    <td align="center" valign="top" bgcolor="#F5F6FA"  width="100%">
      <center>
        <table style="margin: 0 auto;box-shadow: 0px 10px 40px -10px rgba(0,64,128,0.2); " cellpadding="0" cellspacing="0" width="600" class="w320">
          <tr>
            <td align="center" valign="top">
                
                {{-- Header Table --}}
                <table  style="margin: 0 auto;" cellpadding="0" cellspacing="0" width="100%" style="margin:0 auto;" bgcolor="#355C7D">
                  <tr>
                    <td style="font-size: 30px; text-align:center;padding-top: 10px">
                        <img src="{{ $message->embed('img/email/logo__blanco.png') }}" width="45%" alt="parti2">
                    </td>
                  </tr>
                </table>
                
                {{-- Body Table --}}
                <table style="margin: 0 auto;" cellpadding="0" cellspacing="0" width="100%" bgcolor="#fff">
                  <tr>
                    <td>
                      <br>
                      {{-- <img src="{{ asset('img/users.svg') }}" width="216" height="270" alt="Partidos"> --}}
                      <center>
                        @yield('imagen')
                      </center>
                    </td>
                  </tr>
                  <tr>
                    <td class="headline" style="color: #355C7D;font-size: 30px; text-align: center;">
                      @yield('titulo')
                    </td>
                  </tr>
                  <tr>
                    <td>

                      <center>
                        <table style="margin: 0 auto;" cellpadding="0" cellspacing="0" width="60%">
                          <tr>
                            <td style="color:#7d8da0; padding-bottom: 20px; text-align: center;">
                             @yield('descripcion')
                            </td>
                          </tr>
                        </table>
                      </center>

                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div><!--[if mso]>
                        <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="http://" style="height:50px;v-text-anchor:middle;width:200px;" arcsize="8%" stroke="f" fillcolor="#178f8f">
                          <w:anchorlock/>
                          <center>
                        <![endif]-->
                            {{-- Boton de acción --}}
                            <center>
                              <a href="@yield('ruta__boton')"
                            style="background-color:#F67280;border-radius:4px;color:#ffffff;display:inline-block;font-family:Helvetica, Arial, sans-serif;font-size:16px;font-weight:bold;line-height:50px;text-align:center;text-decoration:none;padding:0 30px;-webkit-text-size-adjust:none;">
                                @yield('texto__boton')
                              </a>  
                            </center>

                        <!--[if mso]>
                          </center>
                        </v:roundrect>
                      <![endif]--></div>
                      <br>
                    </td>
                  </tr>
                </table>
                
                 <!-- --Start social network-- -->
                <table  style="margin: 0 auto;" cellpadding="0" cellspacing="0" width="100%" style="margin:0 auto;" bgcolor="#355C7D" class="force-full-width">
                    <tr class="force-full-width">
                      <td style="text-align: center; padding-top: 20px; width: 100%">
                        <a href=""><img src="{{ $message->embed('img/email/facebook.png') }}"></a>
                        <a href=""><img src="{{ $message->embed('img/email/twitter.png') }}"></a>
                      </td>
                    </tr>
                    <tr>
                      <td style="font-size: 16px; color: #fff; text-align:center;padding: 20px 0">
                        <a href="" style="color: #fff;width: 100%">Si necesitas ayuda contáctonos en hola@parti2.com</a>
                      </td>
                    </tr>
                </table>
                <br>
                <center>Todos los derechos reservados <a href="http://parti2.com" target="_blank">Parti2.com</a></center>
                  <!-- --End social network-- -->
            </td>
          </tr>
        </table>
    </center>
    </td>
  </tr>
</table>
</body>
</html>