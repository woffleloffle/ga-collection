using System;
using System.Collections.Generic;
using System.IO;
using System.Linq;
using System.Net;
using System.Text;
using System.Web;
using System.Web.UI;

namespace yournamespace
{


/**
    Google Analytics
 *  @author:  Emmanuel Matsiyana
 *            Flint n Tinder
 *
 *  Google's Mobile Analytics was deprecated.
 *  Rewriting it as per the guidelines here: http://goo.gl/ii3Bvl  
 */
    public class GoogleAnalytics
    {

        // Global function for tracking pageviews and events

        public void GoogleAnalyticsTracking(String Hostname, String Path, String pageTitle, String trackType, String eventCategory, String Action, String Label)
        {


            var GaAccount = "UA-XXXX-Y";
            var request = (HttpWebRequest)WebRequest.Create("http://www.google-analytics.com/collect");
            var hostname = Hostname; // Request.Url.GetLeftPart(UriPartial.Authority);
            var path = Path;        // HttpUtility.UrlEncode(Request.Url.PathAndQuery);
            var pagetitle = pageTitle;
            var userCookie = GetRandomNumber();

            var postData = "v=1";                   //Version
            postData += "&tid=" + GaAccount;    //Tracking ID / Property ID
            postData += "&cid=" + userCookie;   //Client/User ID
            postData += "&t=" + trackType;      //Track type ? Pageview or Event


            if (trackType == "pageview")
            {

                postData += "&dh=" + hostname;       // Document hostname.
                postData += "&dp=" + path;           // Page.
                postData += "&dt=" + pagetitle;      // Title.

            }
            else if (trackType == "event")
            {

                postData += "&ec=" + eventCategory;      // Event Category. Required.
                postData += "&ea=" + Action;         // Event Action. Required.
                postData += "&el=" + Label;         // Event label.
                postData += "&ev=1";                // Event value.

            }

            var data = Encoding.ASCII.GetBytes(postData);

            request.Method = "POST";
            request.ContentType = "application/x-www-form-urlencoded";
            request.ContentLength = data.Length;

            using (var stream = request.GetRequestStream())
            {
                stream.Write(data, 0, data.Length);
            }

            var response = (HttpWebResponse)request.GetResponse();

            var responseString = new StreamReader(response.GetResponseStream()).ReadToEnd();


        }

        private static String GetRandomNumber()
        {
            Random RandomClass = new Random();
            return RandomClass.Next(0x7fffffff).ToString();
        }

    }
}