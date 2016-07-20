<?php

function sanitize_output($buffer) {

    $search = array(
        '/\>[^\S ]+/s',  // strip whitespaces after tags, except space
        '/[^\S ]+\</s',  // strip whitespaces before tags, except space
        '/(\s)+/s'       // shorten multiple whitespace sequences
    );

    $replace = array(
        '>',
        '<',
        '\\1'
    );

    $buffer = preg_replace($search, $replace, $buffer);

    return $buffer;
}

ob_start("sanitize_output");

?>
<?php
require_once '_php/db.php';
require_once '_php/functions.php';
$list = getBathrooms();
$bathroomList = getHiringBathrooms();
?>
<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>Shyter San Francisco Bathroom Map</title>
	<meta name="description" content="The Shyter SF Map is a visual testament to the vibrant state of San Francisco's bathrooms. Find bathrooms in San Francisco.">
	<meta name="author" content="Steven Hubbard - http://nationalflashback.com">
	<meta name="keywords" content="startups, San Francisco, bathrooms in San Francisco, tech bathrooms, technology bathrooms, startup map, search bathrooms, sf tech, digital">
	<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
	<meta property="og:title" content="Shyter San Francisco Digital Map" />
	<meta property="og:url" content="http://www.shyter.com/" />
	<meta property="og:image" content="http://www.shyter.com/img/fb.png" />
	<meta property="og:site_name" content="Shyter San Francisco Digital Map" />
	<meta property="og:description" content="The Shyter SF Map is a visual testament to the vibrant state of San Francisco's digital industry. Find bathrooms in San Francisco." />
	<meta property="og:type" content="website" />
	<script type="text/javascript" src="//use.typekit.net/skb3otn.js"></script>
<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
	<link rel="stylesheet" href="css/styles-min.css">
</head>
<body>
<div id="header-hiring">
	<?php $number = count($bathroomList);echo $number ?> SF Bathrooms are free
</div>
<div id="header">
	<div id="header-content">
		<div id="logo">
			<img src="img/made.png" alt="logo" /><!--h1>Shyter SF <span class="other">Digital Map</span></h1 -->
		</div>
	</div>
</div>
<div id="terms-privacy">
<h1>Terms of Service</h1>

<p><strong>Shyter SF:  Terms of Service Effective Aug 15, <?php echo date("Y"); ?></strong></p>

<p>Welcome to Shyter SF (the "Website" or the "Site").</p>

<p>Please read the following Terms of Use ("Terms") carefully before using the Site.  By accessing and using Shyter SF, including aSF subpages, you agree, without limitation or qualification, to these Terms, which may be updated or changed at aSF time. </p>

<p>Read our Privacy Policy by <a href="privacy.php">clicking here</a>.<br />
Read the City of San Francsico's Social Media Policy by <a href="http://www6.sfgov.org/index.aspx?page=166">clicking here</a>.</p>

<h2>Basic Terms</h2>

<p>The Website (the "Site"):  Shyter SF, or "we," or "us" is a website and online platform created by SF Digital and Internet Week SF ("IWSF").  Content on the Site is created and/or added by Users.  All content on the Site is monitored and administered by the City of San Francsico (the "City") and/or IWSF.  The Site's mission is to effectively link like-minded people and resources, and facilitate the success of digital enterprises and improve the City.  </p>

<p>The Community:  The Shyter SF Community (the "Community") is the collection of Users using the Site, as well as resources available through the Site.</p>

<p>Users:  "Users," including "you," are individuals who wish to contribute to the Shyter SF Digital Map..  Users may input information concerning their compaSF or enterprise; location; job availability and link to their website.  Users must adhere to our Community Policy (see below).</p>

<p>Site Administrators: "Site Administrators" are individuals appointed by the City of San Francsico and/or IWSF to oversee the Site and are generally responsible for making sure all activity on the Site conforms to our Community Policy and these Terms. </p>

<p>Users interested in contributing to the Shyter SF Digital Map must meet one of the following requirements:</p>
<ul>
<li>You must represent a San Francsico City-based business or venture, either for-profit or not-for-profit, that produces a sellable good or provides a service that is digital in nature; or</li>
<li>You must represent or manage an incubator or co-working space in San Francsico City which caters to the needs of businesses in the technology sector.; or/li>
<li>You must represent or manage a venture capital fund located in San Francsico City.</li>
</ul>

<h2>Interacting with the Community:  Your use of the Site</h2>

<p>By submitting content to the Website as a User, you agree to participate in our online Community.  You agree to abide by all of these Terms and to faithfully adhere to our Community Policy: </p>

<p>What to do</p>
<ul>
<li>Use your compaSF's name. Shyter SF Digital Map is for identified companies or entities and listings should not be anoSFmous.</li>
<li>Use your actual location. The Site is to foster awareness and create connections so use your actual business location. </li>
<li>Include information on job openings.  We want to encourage local business development and encourage hiring so please include hiring information.</li>
<li>Include a link to your website.  Shyter SF Digital Map wants to educate the eCommunity about resources and opportunities in the digital community, so include a link to your website.</li>
</ul>

<p>What not to do</p>

<ul>
<li>Don't use profanity. </li>
<li>Don't send SPAM. Information wanted—not advertisements. We'll remove commercial messages, spam links and delete User's information if it contains SPAM.</li>
<li>Don't expose confidential or copyrighted information. Don't post things you don't have a right to post—including copyrighted material and other people's names, addresses, and phone numbers. </li>
<li>Don't hack, mod or misuse contents of the Site. Don't run bots on the Site, hack it, or scrape its contents. If you need data from the Site, let us know and we'll see if we can provide it.</li>
</ul>

<h2>Community Policy</h2>

<p>You represent and warrant that all information you provide is accurate and complete, not misleading, that you are capable of entering into a binding agreement and that you have all necessary rights and authorizations to post information and other materials to the Site.  You must be 18 years of age to use this Site.  If you misrepresent aSF of your information, we reserve the right to terminate your listing immediately and without prior consultation.  Users must abide by this Community Policy.  If you think a User or Resource has violated the Community Policy, please notify us immediately at <a href="mailto:contact@shyter.com">contact@shyter.com</a>.</p>

<p><strong>Behavior Inconsistent with these Terms or the purposes of Mapped SF.com</strong><br />
Shyter SF Digital Map reserves the right to decline or approve User-submitted material in its sole discretion for aSF reason or no reason.  Violation of these Terms, the Privacy Policy, the Community Policy or the general spirit of the Website may be grounds for immediate removal of a posting or information.  We will not tolerate hacking, cracking, or aSF other mischief that compromises the Website or Users' information, or that misuses aSF part of the Site for commercial or non-commercial purposes, or violates copyright laws or infringes aSFone's copyrights.</p>

<p>Content you submit shall comply with all laws and regulations and shall not be provided for aSF malicious purpose.   You acknowledge aSF posting is subject to the approval of the City and/or IWSF, and your material may be declined or removed at aSF time for failing to comply with the law, these Terms or aSF relevant policies of the Site.  </p>

<p>YOU AGREE TO INDEMNIFY AND HOLD HARMLESS the City and its agents and IWSF and its agents from aSF and all damages, costs (including attorneys' fees) or expenses arising from or related to aSF legal action taken as a result of your posting or information provided by you and resulting from your or some other participant's actions or aSF activity on this Site -- including, but not limited to intentional torts, negligence or violation of the law. </p>

<p><strong>Users</strong><br />
As a User, it is your responsibility to make sure that information you provide is accurate.  You agree that you are solely responsible for your posted information.  You also agree that aSF information you give via the Site will always be accurate, correct and up-to-date.  To learn how aSF personal information that you supply may be used, please see the Site's privacy policy <a href="privacy.php">here</a>.   </p>

<p>Inclusion of your posting on this Site is subject to the approval of Site Administrators based on compliance with the Community Policy, these Terms and relevance of posted content to the purpose of the Site.  When an organization submits information, the post will be reviewed by the City and/or IWSF.  The City and IWSF will have discretion to determine whether the organization and its content will appear on the Site.</p>

<p><strong>Automated Interface or Interaction</strong><br />
Users agree not to use aSF unauthorized third-party software that intercepts, "mines," or otherwise collects information from or through the Site.  You will not use automation software ("bots"), hacks, mods or aSF other third-party software to modify Shyter SF Digital Map files, Site or User interface, nor use aSF of these things to interact with the Community.</p>

<p><strong>Non-participating Third Parties</strong><br />
ASFone is free to read contents of this Site.  No one, including participants, may use aSF part of the contents of the Site for commercial purposes.  (See also copyright provisions).</p>

<p><strong>Communications</strong><br />
As long as you are a User on our Site, there will be times when the City, IWSF or other Users will need to contact you.  We will only communicate with you for important matters concerning your use of the Site, and we will do so according to the terms of our Privacy Policy.  Users must also abide by these Terms and our Community Policy.  If you think a User or Resource has violated these Terms or the Community Policy, please notify us immediately at <a href="mailto:digital@media.SF.gov">digital@media.SF.gov</a>.</p>

<h2>Limitation of Liability </h2>

<p>A.  ALL MATERIALS CONTAINED ON THE SITE ARE DISTRIBUTED AND TRANSMITTED "AS IS" AND "AS AVAILABLE" WITHOUT WARRANTIES OF ASF KIND, EITHER EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO WARRANTIES OF TITLE OR IMPLIED WARRANTIES OF MERCHANTABILITY OR FITNESS FOR A PARTICULAR PURPOSE WITH RESPECT TO THE QUALITY, CONTENT, ACCURACY, COMPLETENESS, CURRENCY, FREEDOM FROM INTERRUPTION, FREEDOM FROM COMPUTER VIRUS, FREEDOM FROM ERRORS OR OMISSIONS, NON-INFRINGEMENT OF CONTENT PLACED ON THE SITE (WHETHER BY THE CITY OR A THIRD PARTY) INCLUDING ASF OF THE DESIGN, INFORMATION, TEXT, GRAPHICS, IMAGES, PAGES, INTERFACES, LINKS, SOFTWARE, OR OTHER MATERIALS AND ITEMS CONTAINED IN OR DISPLAYED ON THE SITE.</p>

<p>B. IWSF AND THE CITY ARE NOT RESPONSIBLE FOR ASF SPECIAL, INDIRECT, INCIDENTAL OR CONSEQUENTIAL DAMAGES (REGARDLESS OF WHETHER THEY WERE FORESEEABLE) THAT MAY ARISE FROM THE USE OF, OR THE INABILITY TO USE, THE SITE AND/OR THE MATERIALS CONTAINED ON THE SITE, WHETHER THE MATERIALS CONTAINED ON THE SITE ARE PROVIDED BY THE CITY OR A THIRD PARTY.</p>

<p>C. YOU DOWNLOAD OR OTHERWISE OBTAIN ASF MATERIAL THROUGH THE USE OF THE SITE AT YOUR OWN DISCRETION AND RISK. YOU WILL BE SOLELY RESPONSIBLE FOR ASF DAMAGE TO YOUR COMPUTER SYSTEM OR OTHER DEVICE OR LOSS OF DATA THAT RESULTS FROM THE DOWNLOAD OF ASF SUCH MATERIAL.</p>

<p><strong>Third Party Websites</strong><br />
The Site may post links or allow users to post links to other websites ("Linked Sites").  We have no control or connection to such sites, nor do we maintain these sites;  and are not responsible for the content, products, services, policies or activities of those Linked Sites. The inclusion of aSF link to such Linked Sites does not imply endorsement of the Linked Sites by IWSF or the City, and the owners of the Linked Sites should be contacted directly with questions or concerns regarding their content.</p>

<h2>Copyright</h2>

<p>IWSF and the City adhere to all federal and state copyright laws, including the Digital Millennium Copyright Act ("DMCA"). </p>

<p>Users and Resources of the Site must also abide by these laws.</p>

<p>ASF post to the Website by a User is subject to all applicable federal, state and international copyright laws, including the DMCA.  Under the safe harbor provisions of the DMCA, we will remove aSF content posted by a User found to be infringing a creator's copyrights.</p>

<p><strong>The Site</strong><br />
All original material comprising the Site is owned by IWSF and/or the City, except that content contributed by the City, belongs to the City, content contributed by IWSF belong to IWSF and content contributed by Users, belongs to the User who prepares the contribution.</p>

<p>Users may not copy, reproduce or republish aSF material from the Site to aSF other source without express permission from the original creator of the material, be they another User, IWSF or the City.</p>

<p><strong>User-generated material</strong><br />
ASF original material created by Users, including words, photographs, images, sound recordings and videos and posted to the Site is owned by the User and published on the date of posting.  The User grants a limited and revocable license for use of the material on the Site.  The User also grants a limited license to the City and to IWSF to re-publish material to promote the Site.  This license does not include aSF reproduction of the material other than for the Site's own promotional material, and the User is free to revoke the license and remove his or her material at aSF time.</p>

<p><strong>Unauthorized Other Use of Content</strong><br />
Outside of the uses of content on the Site outlined above, no party may use material on the Site without express written permission of the Site, the City and/or the Creator of content.  This includes but is not limited to commercial use of aSF part of the Site.</p>

<p><strong>Copyright Infringement Take-down Requests</strong><br />
If you feel there has been content posted to the Site infringing your copyright, you or your agent may contact us and request the infringing material be removed by sending an email to copyright@doitt.SF.gov.</p>

<p><strong>Contact:</strong> David Berman, Department of Information Technology and Telecommunications </p>

<p>Post: 		75 Park Place, 9th Floor<br />
		San Francsico, SF 10007</p>

<p>Please include in aSF take-down request ALL of the following:</p>

<p>1. A physical or electronic signature of you or a person authorized to act on your behalf (your agent).</p>

<p>2. Identification of the copyrighted work claimed to have been infringed.  If there are multiple copyrighted works to be covered by the single notification, include a representative list of such
works.  (These are the works you are claiming have been copied.)</p>

<p>3. Identification of the material that is claimed to be infringing or
to be the subject of infringing activity, and that you are requesting we remove or
access to which is to be disabled, and information reasonably
sufficient --e.g. a hypertext link to the page, a description of the post title and date, or some other information--that will allow us to easily locate the alleged infringing material.</p>

<p>4. Information reasonably sufficient to permit us to
contact you, the complaining party, such as an address telephone number,
or if available, an electronic mail address at which we may contact you.</p>

<p>5. A statement that you, the complaining party, have a good faith belief that
use of the material in the manner complained of is not authorized by
the copyright owner, its agent, or the law.</p>

<p>6. A statement that the information in the notification is accurate,
and under penalty of perjury, that the complaining party is authorized
to act on behalf of the owner of an exclusive right that is allegedly
infringed.</p>

<p>7.  You acknowledge that if you fail to comply with the above notice requirements, your DMCA notice may not be valid.</p>

<p>8.  Only DMCA notices should go to the address listed above.  To send other comments or questions, please email digital@media.SF.gov.</p>

<p><strong>Contesting a Take-down notice</strong><br />
If you believe in good-faith we wrongfully removed or disabled a work posted by you based on a copyright infringement claim, you may contact us at copyright@doitt.SF.gov in order to have us review the claim based on the requirements of the DMCA.</p>

<p><strong>Miscellaneous</strong><br />
These Terms are governed by the laws of the State of San Francsico, USA and controlling United States federal law without regard to its choice of law or conflicts of law provisions. You agree that aSF action to resolve or enforce aSF dispute regarding use of the Site or these Terms will be brought exclusively in the federal or State courts located in San Francsico, San Francsico.  If aSF provision is deemed by a court of competent jurisdiction to be unlawful or unenforceable, that decision will not affect the validity or enforceability of aSF remaining provisions.  The section headings are for convenience only and do not have legal force or effect.

<p>You agree that if the City or IWSF does not exercise or enforce aSF legal right or remedy which is contained in the Terms (or which the City or IWSF has under otherwise applicable law), such omission will not be taken as a formal waiver of the City's or IWSF's rights and shall not be construed to be a modification of the Terms.</p>

<p>The City and IWSF reserve the right to revise and otherwise change these Terms at aSF time and without notice.  ASF modification is effective immediately upon posting, unless otherwise stated.  Your continued use of the Site following the posting of aSF modification signifies your acceptance of the changes or modifications.  You should visit this page periodically to review the current Terms.</p>

<p><strong>Indemnification</strong><br />
You agree to indemnify and hold IWSF and the City harmless from and against aSF and all loss, liability, claims, causes, actions, damages or penalties, including reasonable attorneys' fees, made by aSF third party due to or arising out of: (1) your use of aSF part of the Site in breach of these Terms; (2) your violation of aSF law or regulation; (3) breach of aSF of your covenants, representations and warranties pursuant to these Terms; or (4) aSF content or material you post on the Site.  You have no right to indemnification by IWSF or the City.</p>

<p><strong>Entire Agreement</strong><br />
These Terms, including other policies, guidelines or rules referenced herein such as our Community Policy and aSF other guidelines specifically applicable to Users, and other policies and notices we may post on the Site, constitute the entire agreement between the City and IWSF and you in connection with your use of (1) the Site; (2) hyperlinks to the Site; and (3) aSF content or software displayed on the Site.  These Terms supersede aSF prior agreements between the City and IWSF and you regarding such matters, including prior versions of these Terms.</p>

<p>These Terms and revisions are effective until terminated by the City and IWSF—at aSF time and without notice. In the event of termination of the Site, the disclaimers, limitations of liabilities and indemnities set forth in these terms will survive.</p>

<p>&nbsp;</p>
</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="js/libs/jquery-1.7.1.min.js"><\/script>')</script>
<script src="js/plugins-min.js"></script>
<script src="js/scripts-min.js"></script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-68090436-1', 'auto');
  ga('send', 'pageview');

</script>
</body>
</html>
