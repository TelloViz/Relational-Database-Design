</style>
</head>

<body>
    <p style="text-indent: 0pt;text-align: left;"><br /></p>
    <p class="s1" style="padding-top: 1pt;padding-left: 5pt;text-indent: 0pt;line-height: 170%;text-align: left;">Spring
        2022 CPSC 332-02 – File Structures and Databases Project Description</p>
    <p class="s1" style="padding-left: 5pt;text-indent: 0pt;line-height: 19pt;text-align: left;">Instructor: Hokseng Hun
    </p>
    <p style="text-indent: 0pt;text-align: left;"><br /></p>
    <p class="s2" style="padding-left: 5pt;text-indent: 0pt;text-align: left;">[Version 2022.03.16]</p>
    <p style="text-indent: 0pt;text-align: left;"><br /></p>
    <h1 style="padding-top: 2pt;padding-left: 5pt;text-indent: 0pt;text-align: left;">Important Date:</h1>
    <ol id="l1">
        <li data-list-text="1.">
            <p style="padding-top: 9pt;padding-left: 41pt;text-indent: -18pt;text-align: left;">Project Part A – Due on
                Monday, March 28, 2022, 5:00pm</p>
        </li>
        <li data-list-text="2.">
            <p style="padding-top: 1pt;padding-left: 41pt;text-indent: -18pt;text-align: left;">Project Part B – Due on
                Monday, May 16, 2022, 5:00pm</p>
        </li>
    </ol>
    <p style="text-indent: 0pt;text-align: left;"><br /></p>
    <p style="padding-left: 5pt;text-indent: 0pt;line-height: 108%;text-align: left;">Project submission should be made
        via Canvas. Each student should work on the project in groups of 4- 6, and submit a final report, a demo and
        presentation for the project. Each student of the group will be asked to submit a review of their group members,
        where each member will assign the percentage of contribution towards the project for their group members.
        Logically, an equal contribution from each member is expected. Any student who receives a review lower than 25 %
        from their group members may receive a lower grade than other members.</p>
    <p style="text-indent: 0pt;text-align: left;"><br /></p>
    <h1 style="padding-left: 5pt;text-indent: 0pt;line-height: 108%;text-align: left;">Note<span class="p">: Project
            submissions made through email will not be accepted. Only submissions made on Canvas shall receive
            grades.</span></h1>
    <p style="padding-top: 7pt;padding-left: 5pt;text-indent: 0pt;text-align: left;">Maximum Marks: 60 points</p>
    <p style="text-indent: 0pt;text-align: left;"><br /></p>
    <p style="padding-left: 5pt;text-indent: 0pt;line-height: 108%;text-align: left;">The project comprises 2 main
        parts, including extra credit options – for additional functionality or extra credit part.</p>
    <p style="text-indent: 0pt;text-align: left;"><br /></p>
    <h1 style="padding-left: 5pt;text-indent: 0pt;text-align: left;">Database Application Project:</h1>
    <p style="padding-top: 9pt;padding-left: 5pt;text-indent: 0pt;line-height: 108%;text-align: left;">You are a
        freelance software development team that will be receiving a project request from a client about Job Posting
        application.</p>
    <p style="text-indent: 0pt;text-align: left;"><br /></p>
    <p style="padding-left: 5pt;text-indent: 0pt;line-height: 108%;text-align: left;">The client will bring you a set of
        business requirements that his or her company would like you to use to implement the application that they want.
        The client will be strict in ensuring that their requirements are met, so please take note on meeting those
        requirements as a priority. The project you will be commissions for will involve the following:</p>
    <ul id="l2">
        <li data-list-text="-">
            <p style="padding-top: 7pt;padding-left: 41pt;text-indent: -18pt;text-align: left;">Building an ER Diagram
                based on the provided requirements</p>
        </li>
        <li data-list-text="-">
            <p style="padding-left: 41pt;text-indent: -18pt;text-align: left;">Building a Relational Model based on you
                ER Diagram</p>
        </li>
        <li data-list-text="-">
            <p style="padding-top: 1pt;padding-left: 41pt;text-indent: -18pt;text-align: left;">Normalize your database
                to 3NF</p>
        </li>
        <li data-list-text="-">
            <p style="padding-left: 41pt;text-indent: -18pt;text-align: left;">Building the Physical Model inside your
                environment.</p>
        </li>
        <li data-list-text="-">
            <p style="padding-left: 41pt;text-indent: -18pt;text-align: left;">Populating your database with sample
                data.</p>
        </li>
        <li data-list-text="-">
            <p style="padding-left: 41pt;text-indent: -18pt;text-align: left;">Create a demo application to showcase
                your database design in PHP and MySQL</p>
            <p style="text-indent: 0pt;text-align: left;"><br /></p>
            <h1 style="padding-top: 9pt;padding-left: 5pt;text-indent: 0pt;text-align: left;">Client Business
                Requirements:</h1>
            <p style="padding-top: 9pt;padding-left: 5pt;text-indent: 0pt;line-height: 108%;text-align: left;">Your
                customer is called My Job, an American worldwide employment website for job listing. Your team will
                design a database for their job listing website. The database is used for job posting, storing user
                information, and searching jobs.</p>
            <p style="text-indent: 0pt;text-align: left;"><br /></p>
            <p style="text-indent: 0pt;text-align: left;"><span><img width="51" height="15" alt="image"
                        src="Spring%202022%20CPSC%20332%20Project%20Instructions_files/Image_001.png" /></span></p>
            <ol id="l3">
                <li data-list-text="1.">
                    <p style="padding-top: 2pt;padding-left: 41pt;text-indent: -18pt;text-align: left;">Anyone can
                        search any jobs by title and/or location. Location can be city and state, or zip code.</p>
                    <p style="padding-left: 1pt;text-indent: 0pt;line-height: 11pt;text-align: left;">All users</p>
                    <p style="text-indent: 0pt;text-align: left;" />
                </li>
                <li data-list-text="2.">
                    <p class="s3"
                        style="padding-top: 1pt;padding-left: 41pt;text-indent: -18pt;line-height: 107%;text-align: left;">
                        <span class="p">must sign up with a unique email and a very strong password before posting or
                            applying any jobs.</span></p>
                    <p style="text-indent: 0pt;text-align: left;"><span><img width="63" height="15" alt="image"
                                src="Spring%202022%20CPSC%20332%20Project%20Instructions_files/Image_002.png" /></span>
                    </p>
                </li>
                <li data-list-text="3.">
                    <p style="padding-left: 41pt;text-indent: -18pt;line-height: 108%;text-align: left;">Password is at
                        least 8 characters long and must have at least one upper case, one lower case, one number, and
                        one special character.</p>
                    <p style="padding-left: 1pt;text-indent: 0pt;line-height: 11pt;text-align: left;">User</p>
                    <p style="text-indent: 0pt;text-align: left;" />
                </li>
                <li data-list-text="4.">
                    <p style="padding-left: 64pt;text-indent: -41pt;text-align: left;">needs to also provide first name,
                        last name, email, and phone number.</p>
                    <p style="padding-left: 1pt;text-indent: 0pt;line-height: 11pt;text-align: left;">User</p>
                    <p style="text-indent: 0pt;text-align: left;" />
                </li>
                <li data-list-text="5.">
                    <p style="padding-top: 1pt;padding-left: 64pt;text-indent: -41pt;text-align: left;">can sign up
                        multiple times but cannot use the same email address.</p>
                    <p style="text-indent: 0pt;line-height: 11pt;text-align: left;">employee</p>
                    <p style="text-indent: 0pt;text-align: left;" />
                    <p style="text-indent: 0pt;line-height: 11pt;text-align: left;">can sign up as</p>
                    <p style="text-indent: 0pt;text-align: left;" />
                    <p style="padding-left: 1pt;text-indent: 0pt;line-height: 11pt;text-align: left;">Anyone</p>
                    <p style="text-indent: 0pt;text-align: left;" />
                    <p style="text-indent: 0pt;text-align: left;"><span><img width="66" height="15" alt="image"
                                src="Spring%202022%20CPSC%20332%20Project%20Instructions_files/Image_003.png" /></span>
                    </p>
                </li>
                <li data-list-text="6.">
                    <p style="padding-top: 1pt;padding-left: 189pt;text-indent: -166pt;text-align: left;">and/or
                        employer.</p>
                    <p style="padding-left: 1pt;text-indent: 0pt;line-height: 11pt;text-align: left;">employer</p>
                    <p style="text-indent: 0pt;text-align: left;" />
                    <p style="text-indent: 0pt;text-align: left;"><span><img width="66" height="15" alt="image"
                                src="Spring%202022%20CPSC%20332%20Project%20Instructions_files/Image_004.png" /></span>
                    </p>
                    <p style="text-indent: 0pt;text-align: left;"><span><img width="31" height="15" alt="image"
                                src="Spring%202022%20CPSC%20332%20Project%20Instructions_files/Image_005.png" /></span>
                    </p>
                </li>
                <li data-list-text="7.">
                    <p style="padding-top: 1pt;padding-left: 41pt;text-indent: -18pt;text-align: left;">Only can post a
                        job announcement, so to become an employer, a user needs to</p>
                    <p style="padding-top: 1pt;padding-left: 41pt;text-indent: 0pt;line-height: 107%;text-align: left;">
                        provide extra information: Company name, Company Email, Company Phone number, Company address,
                        and Role in Hiring Process. Company Address is optional.</p>
                    <p style="text-indent: 0pt;text-align: left;"><span><img width="62" height="15" alt="image"
                                src="Spring%202022%20CPSC%20332%20Project%20Instructions_files/Image_006.png" /></span>
                    </p>
                    <p style="text-indent: 0pt;text-align: left;"><span><img width="70" height="15" alt="image"
                                src="Spring%202022%20CPSC%20332%20Project%20Instructions_files/Image_007.png" /></span>
                    </p>
                </li>
                <li data-list-text="8.">
                    <p style="padding-left: 41pt;text-indent: -18pt;line-height: 108%;text-align: left;">Employer role
                        in the hiring process includes Owner, CEO, Assistant or Manager, Human Resources Generalist,
                        Hiring Manager, Recruiter, or Other.</p>
                </li>
            </ol>
            <p style="padding-left: 23pt;text-indent: 0pt;text-align: left;">9.</p>
            <p style="padding-left: 23pt;text-indent: 0pt;text-align: left;">10.</p>
            <p style="text-indent: 0pt;text-align: left;"><br /></p>
            <p style="padding-left: 1pt;text-indent: 0pt;line-height: 11pt;text-align: left;">Employer</p>
            <p style="text-indent: 0pt;line-height: 11pt;text-align: left;" />
            <p style="text-indent: 0pt;text-align: left;"><br /></p>
            <p style="padding-left: 1pt;text-indent: 0pt;line-height: 11pt;text-align: left;">Employer</p>
            <p style="text-indent: 0pt;line-height: 11pt;text-align: left;" />
            <p style="padding-top: 1pt;padding-left: 1pt;text-indent: 0pt;text-align: left;">accepted.</p>
            <p style="text-indent: 0pt;line-height: 107%;text-align: left;">can keep track all their job postings and
                view all the candidates who already applied. can review the applicants and update the status: Applied,
                Rejected, Interviewed, or</p>
            <p style="text-indent: 0pt;text-align: left;"><span><img width="62" height="15" alt="image"
                        src="Spring%202022%20CPSC%20332%20Project%20Instructions_files/Image_008.png" /></span></p>
            <ol id="l4">
                <li data-list-text="11.">
                    <p style="padding-top: 1pt;padding-left: 41pt;text-indent: -18pt;text-align: left;">Employer can
                        apply for other jobs and track their application status as well.</p>
                </li>
                <li data-list-text="12.">
                    <p style="padding-top: 1pt;padding-left: 41pt;text-indent: -18pt;text-align: left;">All job postings
                        must include:</p>
                    <ol id="l5">
                        <li data-list-text="a.">
                            <p style="padding-top: 1pt;padding-left: 77pt;text-indent: -18pt;text-align: left;">Job
                                Title</p>
                        </li>
                        <li data-list-text="b.">
                            <p style="padding-top: 1pt;padding-left: 77pt;text-indent: -18pt;text-align: left;">Job
                                Description</p>
                        </li>
                        <li data-list-text="c.">
                            <p style="padding-top: 1pt;padding-left: 77pt;text-indent: -18pt;text-align: left;">Address
                            </p>
                        </li>
                        <li data-list-text="d.">
                            <p style="padding-top: 1pt;padding-left: 77pt;text-indent: -18pt;text-align: left;">
                                Qualifications</p>
                        </li>
                        <li data-list-text="e.">
                            <p style="padding-left: 77pt;text-indent: -18pt;text-align: left;">Responsibilities</p>
                        </li>
                        <li data-list-text="f.">
                            <p
                                style="padding-top: 1pt;padding-left: 77pt;text-indent: -18pt;line-height: 108%;text-align: left;">
                                Education (No Education Required, High School Degree, Associate’s Degree, Bachelor’s
                                Degree, Master’s Degree, or Doctoral Degree)</p>
                        </li>
                        <li data-list-text="g.">
                            <p style="padding-left: 77pt;text-indent: -18pt;text-align: left;">Job Type (Full-Time,
                                Part-Time, Contract, Temporary, or Internship)</p>
                        </li>
                        <li data-list-text="h.">
                            <p style="padding-left: 77pt;text-indent: -18pt;text-align: left;">Contact Details</p>
                        </li>
                        <li data-list-text="i.">
                            <p style="padding-top: 1pt;padding-left: 77pt;text-indent: -18pt;text-align: left;">
                                Experience Level (entry level, mid-level, or senor level)</p>
                            <p style="padding-top: 1pt;padding-left: 59pt;text-indent: 0pt;text-align: left;">j. Salary
                                Range ($35,000+, $40,000+, $50,000+, $70,000+, or $100,000+)</p>
                            <ol id="l6">
                                <li data-list-text="k.">
                                    <p
                                        style="padding-top: 1pt;padding-left: 77pt;text-indent: -18pt;line-height: 107%;text-align: left;">
                                        Benefits (Health Insurance, Vision Insurance, Dental Insurance, Life Insurance,
                                        Pension, and 401(k))</p>
                                </li>
                                <li data-list-text="l.">
                                    <p style="padding-left: 77pt;text-indent: -18pt;text-align: left;">Date Posted</p>
                                </li>
                                <li data-list-text="m.">
                                    <p style="padding-top: 1pt;padding-left: 77pt;text-indent: -18pt;text-align: left;">
                                        Deadline</p>
                                </li>
                            </ol>
                            <p style="text-indent: 0pt;text-align: left;"><span><img width="64" height="15" alt="image"
                                        src="Spring%202022%20CPSC%20332%20Project%20Instructions_files/Image_009.png" /></span>
                            </p>
                        </li>
                    </ol>
                </li>
                <li data-list-text="13.">
                    <p
                        style="padding-top: 1pt;padding-left: 41pt;text-indent: -18pt;line-height: 108%;text-align: left;">
                        Employee can keep track all the jobs they already applied and check their application status:
                        status: Applied, Rejected, Interviewed, or accepted.</p>
                </li>
                <li data-list-text="14.">
                    <p style="padding-left: 41pt;text-indent: -18pt;line-height: 13pt;text-align: left;">All tables must
                        have a timestamp, so we know when the record is inserted.</p>
                </li>
            </ol>
            <p style="text-indent: 0pt;text-align: left;"><br /></p>
            <h1 style="padding-left: 5pt;text-indent: 0pt;text-align: left;">Additional Submission Requirements for the
                Project</h1>
            <ol id="l7">
                <li data-list-text="1.">
                    <p style="padding-top: 9pt;padding-left: 41pt;text-indent: -18pt;text-align: left;">Provide a SQL
                        script to create a database called “myjob” in MySQL server. Make sure that your script can
                        create the database and all the tables without an issue.</p>
                </li>
                <li data-list-text="2.">
                    <p style="padding-left: 41pt;text-indent: -18pt;text-align: left;">Create a VIEW which has first
                        names, last names, and email of all employees who apply more than one jobs.</p>
                </li>
                <li data-list-text="3.">
                    <p style="padding-left: 41pt;text-indent: -18pt;text-align: left;">Create a VIEW which shows the
                        employers (first name, last name, and email) who post more than 3 jobs.</p>
                </li>
                <li data-list-text="4.">
                    <p style="padding-left: 41pt;text-indent: -18pt;text-align: left;">Create a view which shows all
                        users that have both roles (employee and employer)</p>
                </li>
            </ol>
            <p style="text-indent: 0pt;text-align: left;"><br /></p>
            <h1 style="padding-top: 9pt;padding-left: 5pt;text-indent: 0pt;text-align: left;">Extra credit:</h1>
            <p style="padding-top: 9pt;padding-left: 5pt;text-indent: 0pt;text-align: left;">Provide additional
                functionalities and make your website look professional. You can use any free or opensource CSS
                templates that are available on internet. <b>[5 points]</b></p>
            <p style="text-indent: 0pt;text-align: left;"><br /></p>
            <h1 style="padding-top: 9pt;padding-left: 5pt;text-indent: 0pt;text-align: left;">Submission 1 – Project
                Part A [20 points]:</h1>
            <p style="text-indent: 0pt;text-align: left;"><br /></p>
            <p style="padding-left: 5pt;text-indent: 0pt;line-height: 107%;text-align: left;">Submit your ER Diagram and
                your Relational Model (one per group.) Make sure the following are shown:</p>
        </li>
        <li data-list-text="-">
            <p style="padding-top: 8pt;padding-left: 41pt;text-indent: -18pt;text-align: left;">Tables</p>
        </li>
        <li data-list-text="-">
            <p style="padding-left: 41pt;text-indent: -18pt;text-align: left;">Primary keys</p>
        </li>
        <li data-list-text="-">
            <p style="padding-left: 41pt;text-indent: -18pt;line-height: 13pt;text-align: left;">Foreign keys:
                Specifically write foreign keys in a separate table or show through schema diagram</p>
        </li>
        <li data-list-text="-">
            <p style="padding-left: 41pt;text-indent: -18pt;line-height: 13pt;text-align: left;">Relationships</p>
        </li>
    </ul>
    <h1 style="padding-top: 1pt;padding-left: 5pt;text-indent: 0pt;text-align: left;">Submission 2 – Project Part B [30
        points]:</h1>
    <p style="text-indent: 0pt;text-align: left;"><br /></p>
    <p style="padding-left: 5pt;text-indent: 0pt;line-height: 108%;text-align: left;">Submit your development files,
        presentation, and final report (one per group.) For your development files, include a SQL Script of your
        populated database that you created in your environment.</p>
    <p style="text-indent: 0pt;text-align: left;"><br /></p>
    <p style="padding-left: 5pt;text-indent: 0pt;line-height: 108%;text-align: left;">Your final report will outline the
        process of taking the requirements and showing the design process of the database. The recommended outline is as
        follows:</p>
    <p style="text-indent: 0pt;text-align: left;"><br /></p>
    <h1 style="padding-left: 41pt;text-indent: 0pt;line-height: 167%;text-align: left;">Title (Application Name, Project
        Team Name, Class, Date, Team Members) Introduction</h1>
    <h1 style="padding-left: 41pt;text-indent: 0pt;text-align: left;">Database Design Process</h1>
    <p style="padding-top: 9pt;padding-left: 77pt;text-indent: 0pt;line-height: 168%;text-align: left;">Requirements ER
        Diagram Relational Model Physical Model</p>
    <h1 style="padding-left: 41pt;text-indent: 0pt;line-height: 13pt;text-align: left;">Application Design</h1>
    <p style="padding-top: 9pt;padding-left: 77pt;text-indent: 0pt;line-height: 168%;text-align: left;">Overview SQL
        Queries Final Product</p>
    <h1 style="padding-left: 41pt;text-indent: 0pt;line-height: 13pt;text-align: left;">Summary</h1>
    <p style="text-indent: 0pt;text-align: left;"><br /></p>
    <h1 style="padding-left: 5pt;text-indent: 0pt;text-align: left;">Presentations [10 points]:</h1>
    <p style="padding-top: 9pt;padding-left: 5pt;text-indent: 0pt;line-height: 108%;text-align: left;">You will not need
        to present your demo or presentation. However, please submit it so that your demo is in working order and your
        presentation demonstrates the different functions required in your application.</p>
    <p style="text-indent: 0pt;text-align: left;"><br /></p>
    <h1 style="padding-left: 5pt;text-indent: 0pt;text-align: left;">Extra credit:</h1>
    <p style="text-indent: 0pt;text-align: left;"><br /></p>
    <p style="padding-left: 5pt;text-indent: 0pt;line-height: 108%;text-align: left;">In the requirements, there will be
        some opportunities for extra credit. Review closely and see if you want to implement them into your product.</p>
</body>

</html>