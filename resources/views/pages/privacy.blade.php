<?php

use Spatie\SchemaOrg\Schema;

?>
<x-main :title="'Privacy' . ' | ' . config('app.name')" :description="'Privacy Policy'">
    @push('data')
        <?php
        $breadcrumbs = Schema::breadcrumbList()->name('Breadcrumbs')->itemListElement([
            Schema::listItem()->position(1)->item(Schema::webPage()->name('Privacy')->url(to()->privacy())),
        ]);
        echo $breadcrumbs->toScript();
        ?>
    @endpush
    <div class="sm:py-6 sm:py-12">
        <div class="mx-auto py-8 prose px-4 2col:px0">
            <h1>Privacy Policy for {{config('app.name')}}</h1>
            <h2>Introduction</h2>
            <p> At {{config('app.name')}}, we are committed to protecting the privacy of our users, and we recognize the
                importance of safeguarding the personal information we collect from you. This Privacy Policy describes
                the types of information we collect, how we use it, and how we protect your privacy.
            </p>
            <p> By using or accessing our site, you agree to the terms of this Privacy Policy. We may update this
                Privacy Policy from time to time. We encourage you to check this page periodically to ensure that you
                are aware of the most recent version.
            </p>
            <ol>
                <li>
                    <h3>Information We Collect</h3>
                    <p> We may collect the following types of information from our users: </p>
                    <ul>
                        <li>
                            Personal Information: When you interact with our site, we may collect personally
                            identifiable information ("Personal Information") that you voluntarily provide to us, such
                            as your name, email address, and other contact information.
                        </li>
                        <li>
                            Non-Personal Information: We also collect non-personally identifiable information
                            ("Non-Personal Information") when you visit our site, such as your IP address, browser type,
                            operating system, referring website, and pages you visit on our site.
                        </li>
                        <li>
                            Cookies and Web Beacons: We may use cookies, web beacons, and similar technologies to
                            enhance your user experience, to collect Non-Personal Information, and to provide certain
                            features on our site.
                        </li>
                    </ul>
                </li>
                <li>
                    <h3>How We Use Your Information</h3>
                    <p>We may use the information we collect for the following purposes:</p>
                    <ul>
                        <li>
                            To provide, maintain, and improve our site and its content.
                        </li>
                        <li>
                            To communicate with you and respond to your inquiries.
                        </li>
                        <li>
                            To personalize your experience on our site and provide content tailored to your interests.
                        </li>
                        <li>
                            To analyze and monitor usage patterns and trends, and improve the overall quality of our
                            site.
                        </li>
                        <li>
                            To detect, prevent, and address technical issues, and ensure the security of our site.
                        </li>
                        <li>
                            To comply with legal requirements and protect our legal rights.
                        </li>
                    </ul>
                </li>
                <li>
                    <h2>Sharing Your Information</h2>
                    <p>
                        We do not sell, trade, or rent your Personal Information to third parties. We may share your
                        Non-Personal Information with third parties for the purpose of analyzing our site's usage,
                        maintaining its security, or providing certain services.
                    </p>
                    <p> We may also disclose your information in the following circumstances: </p>
                    <ul>
                        <li>
                            When required by law, court order, or legal process.
                        </li>
                        <li>
                            When necessary to protect our rights, property, or safety, or the rights, property, or
                            safety of others.
                        </li>
                    </ul>
                </li>
                <li>
                    <h2>Third-Party Links</h2>
                    <p>
                        Our site may contain links to other websites that are not operated by us. We have no control
                        over and assume no responsibility for the content, privacy policies, or practices of any
                        third-party websites. We encourage you to review the privacy policies of those websites when you
                        visit them.
                    </p>
                </li>
                <li>
                    <h3> Data Security </h3>
                    <p> We take reasonable precautions to protect the security of your information, both online and
                        offline. However, no method of transmission over the Internet or electronic storage is 100%
                        secure, and we cannot guarantee the absolute security of your information.
                    </p>
                </li>
                <li>
                    <h3> Children's Privacy </h3>
                    <p>
                        Our site is not intended for children under the age of 13, and we do not knowingly collect
                        personal information from children under the age of 13. If we become aware that a child under 13
                        has provided us with personal information, we will take steps to delete such information from
                        our records.
                    </p>
                </li>
                <li>
                    <h3> Changes to This Privacy Policy </h3>
                    <p>
                        We reserve the right to update or modify this Privacy Policy at any time. Any changes will be
                        effective immediately upon posting the updated version on our site. Your continued use of our
                        site after any such changes constitutes your acceptance of the new Privacy Policy.
                    </p>
                </li>
                <li>
                    <h3> Contact Us </h3>
                    <p>
                        If you have any questions or concerns regarding this Privacy Policy, please contact us at
                        <a href="mailto:{{config('mail.from.address')}}">{{config('mail.from.address')}}</a>.
                    </p>
                </li>
            </ol>
        </div>
    </div>
</x-main>

