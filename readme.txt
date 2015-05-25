=== Plugin Name ===
Contributors: cchui
Donate link: http://www.leadsourcetracker.com
Requires at least: 3.7
Tested up to: 4.2.2
Stable tag: trunk
Tags: lead source, leadsource, multiple lead source, marketing attribution, campaign attribution, lead source attribution, lead management, sales tracking, deal tracking, opportunity tracking, salesforce tracking, cookie tracking, persistent tracking, visitor tracking, lead tracking, visitor cookie
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

LeadSource Tracker is a simple campaign and marketing attribution that tracks multiple lead sources per visitor.


== Description ==

Finally, marketing attribution that won't break the bank!

LeadSource Tracker is a plugin for Wordpress websites which allows you to tag your inbound links (emails, advertisements, newsletters, press releases, even 
offline venues) so that you can find out where your leads and opportunities are coming from and calculate real ROI.

LeadSource Tracker can attribute MULTIPLE lead sources to a visitor when they register.  When the user registers or places an order on your website, all the 
past campaigns that the user has clicked on can be populated into your forms, where they can be stored in your CRM for reports that consist of marketing attribution to multiple campaigns.  You can even retrieve the lead sources and use the campaign information to customize your web pages.



== Installation ==

1. Upload `leadsourcetracker.free.php` to the `/wp-content/plugins/leadsourcetracker` directory (Make the directory first)

2. Activate the plugin through the 'Plugins' menu in WordPress

3. Go to Settings->LeadSource Tracker and select the page where the lead sources should be retrieved as GET parameters - this is the page where all your campaign parameters will show up as ldsrc_0 and ldsrc_n, where ldsrc_0 is the first campaign, and ldsrc_n is the last campaign that the visitor came through before registering.

4. Populate ldsrc_0 and/or ldsrc_n into your forms through hidden fields so that they may be stored in your CRM system for reporting.

5. Append ?ldsrc=[Campaign Name] to all your landing pages e.g. www.mywebsite.com/product9/?ldsrc=twitter_ads



== Frequently Asked Questions ==

= How do I tag a campaign? =

You can tag any campaign by appending ?ldsrc=[Campaign Name] to any page on your website.  E.g. let's say you have a twitter link into your product page that goes to:  www.mywebsite.com/special_twitter_promo/

To tag the visitor as having come from the special twitter promotion campaign, just enter this as the URL on your tweet:  www.mywebsite.com/special_twitter-
promo/?ldsrc=twitter_promo

As soon as the visitor comes to the landing page through your Tweet, the leadsource "twitter_promo" will be stored in their browser.  Any subsequent campaigns that the visitor comes through will be stored as well.  When the visitor goes to your order / registration page that you specified in Settings->Leadsource Tracker, "twitter_promo", and any subsequent campaigns will be retrieved as GET parameters on that page, which can be easily placed as hidden fields in your registration forms for storage and reporting.


= What happens when the visitor gets to the tagged landing page, then navigates away?  Do I lose the lead source? =

NO.  The lead source information is STORED in the visitor's browser.  It doesn't matter that they don't register or order right away when they click through to your landing page.  If the user goes away and comes back to your home page on their own weeks or months later, then registers on the page you specify in the leadsource tracker settings, the campaigns will be retrieved.


= What is the best practice for tagging? = 

Put the name of the lead source (WHERE they came from), NOT the activity on the website. We have seen MANY people put things like "free_trial", and "whitepaper_download", and "website_download".  These descriptions tell you what they did on the website, not WHERE they came from.  

Proper examples of tagging the "ldsrc" parameter are:  "Google_Adwords", "Adroll_Retargeting", "Emailblast_2015-04-01", "PressRelease_2015-01-31", "Gartner_Profile_Page" etc. - these are all external sources from the website.


= Can I use the tags for offline campaigns? =

YES.  The best practice to achieve offline campaign tracking is to offer a special promotion or coupon on a specific page.  For example if you have a print ad on "Popular Computers Magazine" then create the ad with a link for the special giveaway or promo:  http://www.yourwebsite.com/landingpage/?ldsrc=PCMag_Promo20150401


= I'm using Google UTM, isn't that better? =

Google UTM is great for use with analytics, discovering how people are navigating through your site, where they are entering, where they are leaving, and general website stats.  However it can be quite involved when trying to retrieve the many values and parameters from the visitor's browser.  Additionally it is difficult to get multiple lead sources from Google UTM and if not done correctly, can seriously compromise the data in Analytics.  Our best practice is to keep traffic behavior (analytics) and lead source attribution separate.


= How do I retrieve the lead sources when the visitor registers / orders? =

The lead source information is stored in your visitor's browser every time they come through a campaign.  To retrieve the lead sources, simply go to Settings->LeadSource Tracker and select the page (usually your order form or registration page) and click save.  This page will retrieve the lead sources and populate the URL with GET parameters.  In your contact form, populate hidden fields with the GET parameters that show up in the URL. 

First, check to see if your contact form plugin already supports pulling in GET parameter tags from the URL (like Gravity Forms).  If it does, then simply map the ldsrc_0 (first first touch) and/or ldsrc_n (for last touch) GET variables into hidden fields.  Remember to map these to your CRM as well.

If you are using a custom PHP form, then include the following the page your specified in Settings->LeadSource Tracker:

&lt;input type="hidden" name="first_source" value="&lt;?php echo $_GET['ldsrc_0'];?&gt;">
&lt;input type="hidden" name="last_source" value="&lt;?php echo $_GET['ldsrc_n'];?&gt;">

where ldsrc_0 is the first campaign the visitor ever saw,
and ldsrc_n is the last campaign the visitor ever saw.


In the Pro and Enterprise editions, you can retrieve 

the first (ldsrc_0), last (ldsrc_n) and everything in between (ldsrc_1 .. ldsrc_999) for multiple pages on your website.  You can find more information at http://www.leadsourcetracker.com





== Screenshots ==

1. Define the page on your wordpress website which will retrieve the campaign tags stored in the visitors browser.  Most often this is the order or registration, or contact page.
2. Tag your online (or offline) inbound links with your marketing activity or campaign name.  Simply append ?ldsrc=[Campaign Name] after the landing page.  In this example, the inbound link was from a tradeshow banner ad and the landing page was the homepage. "Tradeshow_VMworld2015" is stored on the visitor's browser so that it can be retrieved when he or she registers on your website.
3. Let's say the visitor came back through ANOTHER campaign after the Tradeshow_VMworld2015, in this case he or she came back through Google_Adwords.  "Google_Adwords" is now stored on the visitor's browser in ADDITION to "Tradeshow_VMworld2015".  
4. When the visitor finally registers or orders off your website, "Tradshow_VMworld2015" and "Google_Adwords" are retrieved from the visitor's browser and is made available as GET parameters in the URL.  Allowing you to populate the information in hidden form fields for storage.  Now you know that "John Doe", was first touched by Tradeshow_VMworld2015, and the last touch before registration was Google_Adwords!
5. Example using Gravity Forms on pulling campaigns as GET parameters for FIRST TOUCH campaigns into hidden form fields.
6. Another example using Gravity Forms on pulling campaigns as GET parameters for LAST TOUCH campaigns into hidden form fields.

== Changelog ==

= 1.0 =
* Initial Release



== Arbitrary section ==

== Upgrade Notice ==


`<?php code(); // goes in backticks ?>`