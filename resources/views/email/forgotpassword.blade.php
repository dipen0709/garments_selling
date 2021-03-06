<!DOCTYPE html>
<html>
<head>
	<title>Forgot Password</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<style type="text/css">
		/* FONTS */
		@media screen {
			@font-face {
				font-family: 'Lato';
				font-style: normal;
				font-weight: 400;
				src: local('Lato Regular'), local('Lato-Regular'), url(https://fonts.gstatic.com/s/lato/v11/qIIYRU-oROkIk8vfvxw6QvesZW2xOQ-xsNqO47m55DA.woff) format('woff');
			}

			@font-face {
				font-family: 'Lato';
				font-style: normal;
				font-weight: 700;
				src: local('Lato Bold'), local('Lato-Bold'), url(https://fonts.gstatic.com/s/lato/v11/qdgUG4U09HnJwhYI-uK18wLUuEpTyoUstqEm5AMlJo4.woff) format('woff');
			}

			@font-face {
				font-family: 'Lato';
				font-style: italic;
				font-weight: 400;
				src: local('Lato Italic'), local('Lato-Italic'), url(https://fonts.gstatic.com/s/lato/v11/RYyZNoeFgb0l7W3Vu1aSWOvvDin1pK8aKteLpeZ5c0A.woff) format('woff');
			}

			@font-face {
				font-family: 'Lato';
				font-style: italic;
				font-weight: 700;
				src: local('Lato Bold Italic'), local('Lato-BoldItalic'), url(https://fonts.gstatic.com/s/lato/v11/HkF_qI1x_noxlxhrhMQYELO3LdcAZYWl9Si6vvxL-qU.woff) format('woff');
			}
		}

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
</head>
<body style="background-color: #f4f4f4; margin: 0 !important; padding: 0 !important;">
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;" >
                        <tr>
                            <td bgcolor="#ffffff" align="left" style="padding: 10px 30px 10px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;" >
                                <h1>Hi @username,</h1>
								<p>There was recently a request to change the password for your account.</p>
								<p>If you requested this password change, please reset your password here:</p>
                               <table cellspacing="0" cellpadding="0" class="action-button" >
									<tr>
										<td>
											<a href="@user_rp_token_url"><span>Reset Password</span></a>
										</td>
									</tr>
								</table>
								<p>If you did not make this request, you can ignore this message and your password will remain the same.</p>
				            </td>
                        </tr>
						<tr>
                            <td bgcolor="#ffffff" align="left" style="padding: 10px 30px 10px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;" >
                                <p style="margin: 0; text-align: left;">Thank You</p>
			                </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
	</body>
</html> 