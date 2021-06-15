# Ability to Find Best Rates for Loan
As a student, I would like to have the ability to find the best rates for a loan before taking one out.

**Acceptance Criteria**
| User Action | System Response |
|---|---|
| User accesses loan web page | Web page prompts login |
| User logs in | Web page responds with either success or failure |
| User navigates to new loan page | Web page shows list of new loans |
| User filters new loans by rate | Web page prioritizes loans with good rates in list |

# View Credit Reports from Each Major Bank Bureau
As a bank officer, I would like a screen that allows me to view the credit reports from each of the major credit bureaus for each student

**Acceptance Criteria**
| User Action | System Response |
|---|---|
| Officer accesses loan web page | Web page prompts login |
| Officer logs in | Web page responds with either success or failure |
| Officer navigates to pending reviews | Web page lists pending reviews |
| Officer navigates to one pending review | Web page displays detailed information of review |
| Officer clicks on user profile | Web page displays user information, if credit is cached from previous request it is displayed |
| Officer requests credit bureau check | Web page checks credit with the major credit bureaus and displays them |

# Loan/Bank Officer View All Active Loans
As a loan officer/bank officer, I would like to have a list of all active loans and their current statuses

**Acceptance Criteria**
| User Action | System Response |
|---|---|
| Officer accesses loan web page | Web page prompts login |
| Officer logs in | Web page responds with either success or failure |
| Officer navigates to active loan page | Web page responds with list of all active loans, along with statuses of all loans |

# Apply for a Loan
As a student, I would like to be able to apply for a loan from the web page.

**Acceptance Criteria**
| User Action | System Response |
|---|---|
| User accesses loan web page | Web page prompts login |
| User logs in | Web page responds with either success or failure |
| User clicks "Apply Here" to apply for loan | Web page takes user to list of available loans |
| User selects filters for appropriate loan | Web page applies filters |
| User clicks "apply for loan" on loan of their choosing | Web page moves loan with all relevant details to pending state for officer to review |

# Monthly Payment Calculator
As a student, I want an expected monthly payment calculator to see how much a loan will cost once repayment starts.

**Acceptance Criteria**
| User Action | System Response |
|---|---|
| User accesses loan web page | Web page prompts login |
| User logs in | Web page responds with either success or failure |
| User navigates to monthly repayment | Web page brings up monthly repayment |
| User plays with sliders to see how long it'll take to repay a loan at a specific amount/month | Web page responds accordingly |

# Living Expense Loans
As a user, I want to take out loans specific to living expenses so I can be reimbursed for rent/books required by my school.

**Acceptance Criteria**
| User Action | System Response |
|---|---|
| User accesses loan web page | Web page prompts login |
| User logs in | Web page responds with either success or failure |
| User navigates to loan list | Web page provides list of loans |
| User chooses loan to take out | Web page takes them to form to fill out |
| User specifies loan as a living expense loan | Web page flags loan as living expense & asks for account to reimburse |
| User provides account to direct-deposit into | Web page forwards information to bank officer |

# View Student Loans
As a member of the registrar, I would like to see what students have loans and how much those loans are and be able to filter by student, school and bank.

**Acceptance Criteria**
User Action | Expected Result
------------ | -------------
Log in as registrar user | Login successful, forwarded to registrar portal.
Navigate to page to view loans | Screen appears, listing all student loans.
Select dropdown to filter by student | Options listed are only the students who appear in the loan table.
Select a student from the dropdown and hit "Search." | Results filtered to only show loans to specified student.
Select dropdown to filter by school | Options listed are only the schools that appear in the loan table.
Select a school from the dropdown and hit "Search." | Results filtered to only show loans to students who attend specified school.
Select dropdown to filter by bank | Options listed are only the banks that appear in the loan table.
Select a bank from the dropdown and hit "Search." | Results filtered to only show loans to students from specified bank.

# Billing Screen
As a member of the registrar, I would like a screen for knowing how much of a student's tuition is being paid through loans.

**Acceptance Criteria**
| User Action | System Response |
|---|---|
| Registrar accesses loan web page | Web page prompts login |
| Registrar logs in | Web page responds with either success or failure |
| Registrar navigates to billing screen | Web page provides list of students |
| Registrar selects student | Web page displays how much that student will be paying in loans and by which bank. Shows remaining tuition after loans. |

# Payment Breakdown
As a member of the registrar, I would like a screen to see the amount of payment I can expect from a student after loans have been applied.

**Acceptance Criteria**
| User Action | System Response |
|---|---|
| Registrar accesses loan web page | Web page prompts login |
| Registrar logs in | Web page responds with either success or failure |
| Registrar navigates to user list | Web page responds with list of students available to registrar |
| Registrar selects student and navigates to payment details | Web page provides details of student payment, including how much the student will have to pay after their loans |

# Loan Risk Calculator
As a loan officer, I would like a loan risk calculator that determines whether or not a student should be approved for a loan. 

**Acceptance Criteria**
| User Action | System Response |
|---|---|
| Officer accesses loan web page | Web page prompts login |
| Officer logs in | Web page responds with either success or failure |
| Officer navigates to pending loans | Web page provides list of pending loans |
| Officer selects pending loan | Web page provides details of pending loan |
| Officer selects "Calculate Risk" button | Web page calculates the risk for approving a loan, and gives a recommendation of whether to accept or reject the loan based on that risk |

# Loan Information
 As a bank officer, I would like to see the financial information of everyone who has a loan with my bank

**Acceptance Criteria**
| User Action | System Response |
|---|---|
| Officer accesses loan web page | Web page prompts login |
| Officer logs in | Web page responds with either success or failure |
| Officer navigates to loan list | Web page responds with list of loans |
| Officer selects accepted loan | Web page provides fincancial information of the person who has taken the loan |

# List Pending Loan Applications
As a loan officer, I would like to have a list of all pending loan applications for review.

**Acceptance Criteria**

| What the user tries to do | What the system responds with|
|------|-----------|
| Officer navigates to web page | Web page prompts login |
| Officer provides login credentials | Web page accepts or rejects credentials |
| Officer navigates to pending applications | Web page displays list of all pending applications with a quick overview |
| Officer selects application for review | Web page displays in-depth contents of application |
| Officer selects accept or reject application | Web page responds appropriately, accepting or rejecting the application |

# Login System
**Description**
As a user of the system, I should be able to log in.

**Acceptance Criteria**
User Action | Expected Result
------------ | -------------
User types in bad credentials and submits the page. | Notice appears that the login information is incorrect.
User types in correct credentials and submits the page. | Redirected to user-specific page.

# Approve Loan
As a loan officer, I would like to approve a loan that is presented to me so that the student gets the money from the loan.

**Acceptance Criteria**
| Step | System Response|
|---|---|
| Officer navigates to loan page | System provides loan page |
| Officer clicks loan | System provides details of loan |
| Officer clicks *Approve* or "Deny" | System approves or denies loan and responds with success or failure |

