<!DOCTYPE html>
<html lang="en">
<head>
    <!--Google Login Button-->
    <meta name="google-signin-scope" content="profile email">
    <meta name="google-signin-client_id" content='212748848744-vr854thj6aem89gqt2l7nm9ahfprqt10.apps.googleusercontent.com'>
    <script src="https://apis.google.com/js/platform.js" async defer></script>

    <script>
    
        function signOut() {
             google.accounts.id.revoke('sydcarpe@iu.edu', done => {
                alert('consent revoked');
              });
            }
        debugger;
        signOut();
    </script>

</head>


</html>