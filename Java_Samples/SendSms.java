import java.io.UnsupportedEncodingException;
import java.util.ArrayList;
import org.apache.http.HttpEntity;
import org.apache.http.HttpResponse;
import org.apache.http.NameValuePair;
import org.apache.http.client.HttpClient;
import org.apache.http.client.entity.UrlEncodedFormEntity;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.message.BasicNameValuePair;
import org.apache.http.util.EntityUtils;
import org.apache.commons.codec.binary.Base64;

public class SendUnicodeSms {

    public static void main(String[] args) throws NoSuchFieldException, 
                                                SecurityException, 
                                                IllegalArgumentException, 
                                                IllegalAccessException, 
                                                UnsupportedEncodingException {
        HttpClient client = new DefaultHttpClient();
        ArrayList<NameValuePair> postParameters = new ArrayList<NameValuePair>();
        postParameters.add(new BasicNameValuePair("From", "<ExoPhone>"));
        postParameters.add(new BasicNameValuePair("To", "<To Number>"));
        String body = "Magic. Do not touch.";
        String out = new String(body.getBytes("UTF-8"), "ISO-8859-1");
        postParameters.add(new BasicNameValuePair("Body", out));
        
        //Replace <sid> with your account sid
        String sid = "<sid>";
        //Replace <token> with your secret token
        String authStr = sid + ":" + "<token>";
        String url = "https://" + 
                        authStr + "@twilix.exotel.in/v1/Accounts/" + 
                        sid + "/Sms/send";
        byte[] authEncBytes = Base64.encodeBase64(authStr.getBytes());
        String authStringEnc = new String(authEncBytes);
        HttpPost post = new HttpPost(url);
        post.setHeader("Authorization", "Basic " + authStringEnc);
        try {
            post.setEntity(new UrlEncodedFormEntity(postParameters));
        } catch (UnsupportedEncodingException e) {
            e.printStackTrace();
        }
        try {
            HttpResponse response = client.execute(post);
            int httpStatusCode = response.getStatusLine().getStatusCode();
            System.out.println(httpStatusCode + "is the status code");
            HttpEntity entity = response.getEntity();
            System.out.println(EntityUtils.toString(entity));
        } catch (Exception e) {
            e.printStackTrace();
        }
    }
}
