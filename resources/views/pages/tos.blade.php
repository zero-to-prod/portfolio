<x-main :title="'Privacy' . ' | ' . config('app.name')">
    <div class="sm:py-6 sm:py-12">
        <div class="mx-auto py-8 prose px-4 2col:px0">
            <h1>Terms of Service for {{config('app.name')}}</h1>
            <h2>Introduction</h2>
            <p>
                Welcome to {{config('app.name')}} ("Website," "Site," "we," "us," or "our"). These Terms of Service
                ("Terms") govern your access to and use of the website located at {{config('app.url')}} and any content,
                functionality, or services offered on or through the website. By using the Site or by clicking to accept
                or agree to the Terms when this option is made available to you, you accept and agree to be bound and
                abide by these Terms and our Privacy Policy, incorporated herein by reference. If you do not want to
                agree to these Terms or the Privacy Policy, you must not access or use the Site.
            </p>
            <ol>
                <li>
                    <h3>Eligibility</h3>
                    <p>
                        To access or use the Site, you must be at least 18 years of age, or the age of majority in your
                        jurisdiction, whichever is greater. By using the Site, you represent and warrant that you meet
                        this eligibility requirement.
                    </p>
                </li>
                <li>
                    <h3>Changes to the Terms</h3>
                    <p>
                        We may revise and update these Terms from time to time in our sole discretion. All changes are
                        effective immediately when we post them and apply to all access to and use of the Site
                        thereafter. Your continued use of the Site following the posting of revised Terms means that you
                        accept and agree to the changes.
                    </p>
                </li>
                <li>
                    <h3>Content Ownership and Responsibility</h3>
                    <p>
                        All content on the Site, including but not limited to text, graphics, images, and logos, is the
                        property of {{config('app.name')}} or its content suppliers and is protected by copyright and
                        other
                        intellectual property laws. You agree not to reproduce, distribute, modify, or create derivative
                        works from any of the materials on the Site without our express written permission.
                    </p>
                </li>
                <li>
                    <h3>User-Generated Content</h3>
                    <p>
                        If the Site allows you to submit, post, or share content, you agree that you are solely
                        responsible for any user-generated content you submit, and you represent and warrant that you
                        have all necessary rights to submit such content. By submitting user-generated content, you
                        grant {{config('app.name')}} a non-exclusive, royalty-free, perpetual, irrevocable, and
                        sublicensable
                        right to use, reproduce, modify, adapt, publish, translate, create derivative works from,
                        distribute, and display such content throughout the world in any media.
                    </p>
                </li>
                <li>
                    <h3>Prohibited Conduct</h3>
                    <p>
                        You agree not to engage in any of the following activities on the Site:
                    </p>
                    <ul>
                        <li>
                            a. Post, transmit, or otherwise make available any content that is unlawful, harmful,
                            threatening, abusive, harassing, defamatory, vulgar, obscene, invasive of another's privacy,
                            hateful, or racially, ethnically, or otherwise objectionable;
                        </li>
                        <li>
                            b. Impersonate any person or entity, or falsely state or otherwise misrepresent your
                            affiliation with a person or entity;
                        </li>
                        <li>
                            c. Upload, post, or otherwise transmit any content that you do not have a right to transmit
                            under any law or under contractual or fiduciary relationships;
                        </li>
                        <li>
                            d. Violate any applicable local, state, national, or international law;
                        </li>
                        <li>
                            e. Use the Site for any purpose that is unlawful or prohibited by these Terms.
                        </li>
                    </ul>
                </li>
                <li>
                    <h3>Disclaimer of Warranties and Limitation of Liability</h3>
                    <p>
                        The Site is provided on an "as is" and "as available" basis. {{config('app.name')}} makes no
                        representations or warranties of any kind, express or implied, as to the operation of the Site
                        or the information, content, materials, or products included on the Site. To the full extent
                        permissible by applicable law, {{config('app.name')}} disclaims all warranties, express or
                        implied,
                        including, but not limited to, implied warranties of merchantability and fitness for a
                        particular purpose. {{config('app.name')}} will not be liable for any damages of any kind
                        arising from
                        the use of the Site, including, but not limited to, direct,indirect, incidental, punitive, and
                        consequential damages.
                    </p>
                </li>
                <li>
                    <h3>Indemnification</h3>
                    <p>
                        You agree to indemnify, defend, and hold harmless {{config('app.name')}}, its officers,
                        directors,
                        employees, agents, licensors, and suppliers from and against all losses, expenses, damages, and
                        costs, including reasonable attorneys' fees, resulting from any violation of these Terms or any
                        activity related to your use of the Site (including negligent or wrongful conduct) by you or any
                        other person accessing the Site using your account.
                    </p>
                </li>
                <li>
                    <h3>Termination</h3>
                    <p>
                        We reserve the right, in our sole discretion, to terminate your access to all or part of the
                        Site, with or without notice, for any reason, including, without limitation, if we believe that
                        you have violated or acted inconsistently with the letter or spirit of these Terms. You agree
                        that {{config('app.name')}} shall not be liable to you or any third party for any termination of
                        your
                        access to the Site.
                    </p>
                </li>
                <li>
                    <h3>Governing Law and Jurisdiction</h3>
                    <p>
                        These Terms and any disputes or claims arising out of or in connection with them or their
                        subject matter or formation shall be governed by and construed in accordance with the laws of
                        the United States Government. You agree that any legal action or proceeding
                        between {{config('app.name')}} and you for any purpose concerning these Terms or the parties'
                        obligations hereunder shall be brought exclusively in a federal or state court of competent
                        jurisdiction sitting in the United States Government.
                    </p>
                </li>
                <li>
                    <h3>Severability</h3>
                    <p>
                        If any provision of these Terms is found to be invalid or unenforceable by a court of competent
                        jurisdiction, the remaining provisions shall remain in full force and effect, and the invalid or
                        unenforceable provision shall be deemed superseded by a valid, enforceable provision that most
                        closely matches the intent of the original provision.
                    </p>
                </li>
                <li>
                    <h3>Entire Agreement</h3>
                    <p>
                        These Terms, together with the Privacy Policy, constitute the entire agreement between you and
                        {{config('app.name')}} with respect to the Site and supersede all prior or contemporaneous
                        understandings and agreements, whether written or oral, with respect to the Site.
                    </p>
                </li>
                <li>
                    <h3>Contact Information</h3>
                    <p>
                        If you have any questions, concerns, or comments about these Terms or the Site, you may contact
                        us at <a href="mailto:{{config('mail.from.address')}}">{{config('mail.from.address')}}</a>.
                    </p>
                </li>
            </ol>
        </div>
    </div>
</x-main>

