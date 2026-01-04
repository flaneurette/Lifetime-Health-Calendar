

## Lifetime Health Calendar Generator

The **Lifetime Health Calendar Generator** creates a personalized medical checkup calendar starting from today and extending up to 90 years of age. You enter your birth date, select the health screenings and reminders that apply to you, and the tool generates a standards-compliant **`.ics` calendar file**. This file can be imported into most calendar systems, including mobile phones, desktop calendars, and email-based calendars.

### Possible limitations.

- Google calendar might not import any event beyond 2036, due to 32-bit Unix time issues.
- The maximum filesize generated is around: 512Kb for 90 years, some software might find that calendar too big (rare, but possible)
- Some software might not create events beyond a certain date, perhaps not setting dates up to 90 years into the future.
- The less events you select, the more likely the .ics will not give certain issues.
  
> To be certain: create a dummy account with your calendar software, and import the `.ics` as test. If it works, delete the dummy and import it in your real account.
> Always check the imported dates manually.
> Then set it and forget it, mostly.

### Requirements

A server to upload the index and json files.

### Dates

Always check the `events.json` for accurate dates and intervals. In your country, screening or vaccines might be done on a different age.

### What it does

* Generates long-term health reminders based on age
* Includes screenings, vaccinations, dental visits, and birthdays
* Allows fine-grained control using checkboxes (enabled by default)
* Skips dates in the past automatically
* Spreads events over months to avoid notification overload
* Produces an open **ICS (RFC 5545)** calendar for maximum compatibility

### Important notes

* Your **birth date must be correct** - incorrect input will shift all generated dates
* To make the calendar smaller, select less events (like not selecting birthday, removes a max of 90 possible events)
* The more screenings you enable, the larger the calendar becomes
* Some years may contain multiple events on the same day if many checks are selected
* Only select medical screenings that apply to your situation
* When you generate the .ics file, make a backup of it to restore it in the future if required. (or simply generate a new .ics, so keep the software as backup)
* Future apps may change, deprecate and so on. The .ics file will likely still be useful, since it's build upon RFC standards.

### Why ICS?

The `.ics` format is an open, long-standing calendar standard supported by:

* Android & iOS calendars
* Google Calendar, Outlook, Apple Calendar
* Desktop calendar apps and email systems

This makes the calendar usable **offline, portable, and durable over decades**, without relying on any specific platform or service.

### Privacy-friendly

* Runs entirely in the browser
* No accounts, no tracking, no data upload
* Your health data never leaves your device

---

> Note: this is not medical advise. Please consult a doctor if you need screenings or checkups.
> Science may change over years and decades, always review it often.
>

---

# Default events

The file events.json contains common screenings, events and vaccination dates. You can edit these and chnage them, accordingly to the schedule of your location which might be different. You could also add or remove events. Below are the default events. It might not seem much, but they can quickly fill your calendar because they are programatically added year, semi-yearly etc, so check/uncheck them carefully to prevent many events happening on a single day.

```
[
  {
    "category": "Birthday",
    "subEvents": [
      { "title": "Annual Birthday", "age": 0, "frequency": "yearly", "description": "Your Birthday!", "reminderDays": 1 }
    ]
  },
  {
    "category": "Vaccines",
    "subEvents": [
      { "title": "Flu Vaccine", "age": 60, "frequency": "yearly", "description": "Annual influenza vaccine", "reminderDays": 1 },
      { "title": "COVID Booster", "age": 18, "frequency": "yearly", "description": "COVID booster", "reminderDays": 1 },
      { "title": "Tdap Booster", "age": 18, "frequency": "every-10-years", "description": "Tetanus, diphtheria, and pertussis booster", "reminderDays": 1 },
      { "title": "Tetanus Booster", "age": 28, "frequency": "every-10-years", "description": "Tetanus booster every 10 years", "reminderDays": 1 },
      { "title": "HPV Vaccine", "age": 18, "maxAge": 26, "frequency": "once", "description": "HPV vaccine series (if not already completed)", "reminderDays": 7 },
      { "title": "HPV Vaccine (50+)", "age": 50, "maxAge": 55, "frequency": "once", "description": "HPV vaccine series (if not already completed)", "reminderDays": 7 },
      { "title": "MMR Vaccine", "age": 18, "frequency": "once", "description": "Measles, mumps, rubella (if not previously vaccinated)", "reminderDays": 1 },
      { "title": "Varicella Vaccine", "age": 18, "frequency": "once", "description": "Chickenpox vaccine (if not previously vaccinated)", "reminderDays": 1 },
      { "title": "Shingles Vaccine", "age": 50, "frequency": "once", "description": "Shingrix 2-dose series recommended at 50", "reminderDays": 1 },
      { "title": "Pneumococcal Vaccine", "age": 65, "frequency": "once", "description": "Pneumonia vaccine for adults 65+", "reminderDays": 1 },
      { "title": "RSV Vaccine", "age": 60, "frequency": "once", "description": "Respiratory syncytial virus vaccine", "reminderDays": 1 },
      { "title": "Hepatitis A Vaccine", "age": 18, "frequency": "once", "description": "Hepatitis A vaccine series (if at risk)", "reminderDays": 7 },
      { "title": "Hepatitis B Vaccine", "age": 18, "frequency": "once", "description": "Hepatitis B vaccine series (if not previously vaccinated)", "reminderDays": 7 },
      { "title": "Meningococcal Vaccine", "age": 18, "maxAge": 25, "frequency": "once", "description": "Meningitis vaccine (if not previously vaccinated)", "reminderDays": 7 }
    ]
  },
  {
    "category": "Cancer Screenings",
    "subEvents": [
      { "title": "Skin Cancer Check", "age": 18, "frequency": "every-2-years", "description": "Full body skin examination by dermatologist", "reminderDays": 7 },
      { "title": "Colon Cancer Screening", "age": 45, "maxAge": 75, "frequency": "every-2-years", "description": "Colonoscopy (or other method every 1-5 years)", "reminderDays": 14 },
      { "title": "Breast Cancer Screening", "age": 40, "frequency": "every-2-years", "description": "Mammogram screening for women", "reminderDays": 7 },
      { "title": "Cervical Cancer Screening", "age": 21, "maxAge": 65, "frequency": "every-3-years", "description": "Pap smear (every 3-5 years depending on method)", "reminderDays": 7 },
      { "title": "Prostate Cancer Screening", "age": 50, "frequency": "every-2-years", "description": "PSA test and exam for men (discuss with doctor)", "reminderDays": 7 },
      { "title": "Lung Cancer Screening", "age": 50, "maxAge": 80, "frequency": "yearly", "description": "Low-dose CT scan (for current/former smokers)", "reminderDays": 7 },
      { "title": "Ovarian Cancer Risk Assessment", "age": 30, "frequency": "every-5-years", "description": "Family history and risk factor assessment", "reminderDays": 7 },
      { "title": "Pancreatic Cancer Screening", "age": 50, "frequency": "every-3-years", "description": "For those with family history or high risk", "reminderDays": 14 },
      { "title": "Oral Cancer Screening", "age": 18, "frequency": "every-2-years", "description": "Oral cavity examination (often during dental visits)", "reminderDays": 3 }
    ]
  },
  {
    "category": "Cardiovascular Health",
    "subEvents": [
      { "title": "Blood Pressure Check", "age": 18, "frequency": "yearly", "description": "Annual blood pressure screening", "reminderDays": 3 },
      { "title": "Cholesterol Screening", "age": 20, "frequency": "every-5-years", "description": "Lipid panel screening", "reminderDays": 7 },
      { "title": "EKG (Electrocardiogram)", "age": 40, "frequency": "every-5-years", "description": "Baseline heart rhythm test", "reminderDays": 7 },
      { "title": "Stress Test", "age": 50, "frequency": "every-5-years", "description": "Cardiac stress test (if indicated)", "reminderDays": 14 },
      { "title": "Echocardiogram", "age": 60, "frequency": "every-5-years", "description": "Heart ultrasound screening", "reminderDays": 14 },
      { "title": "Carotid Artery Screening", "age": 65, "frequency": "every-5-years", "description": "Ultrasound for carotid artery disease", "reminderDays": 7 },
      { "title": "Abdominal Aortic Aneurysm Screening", "age": 65, "frequency": "once", "description": "Ultrasound screening for men who have smoked", "reminderDays": 7 },
      { "title": "Peripheral Artery Disease Screening", "age": 65, "frequency": "every-5-years", "description": "Ankle-brachial index test", "reminderDays": 7 }
    ]
  },
  {
    "category": "Metabolic Health",
    "subEvents": [
      { "title": "Diabetes Screening", "age": 35, "frequency": "every-3-years", "description": "Blood glucose/A1C screening", "reminderDays": 7 },
      { "title": "Prediabetes Screening", "age": 30, "frequency": "every-3-years", "description": "Fasting glucose and A1C", "reminderDays": 7 },
      { "title": "Thyroid Screening", "age": 35, "frequency": "every-5-years", "description": "TSH test for thyroid function", "reminderDays": 3 },
      { "title": "Metabolic Syndrome Screening", "age": 40, "frequency": "every-3-years", "description": "Comprehensive metabolic risk assessment", "reminderDays": 7 },
      { "title": "Hemoglobin A1C Test", "age": 40, "frequency": "yearly", "description": "3-month average blood sugar test", "reminderDays": 3 }
    ]
  },
  {
    "category": "Bone & Joint Health",
    "subEvents": [
      { "title": "Bone Density Test", "age": 65, "frequency": "every-2-years", "description": "DEXA scan for osteoporosis screening", "reminderDays": 7 },
      { "title": "Bone Density Test (Postmenopausal)", "age": 50, "frequency": "every-2-years", "description": "DEXA scan for postmenopausal women at risk", "reminderDays": 7 },
      { "title": "Vitamin D Level", "age": 18, "frequency": "yearly", "description": "Vitamin D screening for bone health", "reminderDays": 3 },
      { "title": "Calcium Level", "age": 50, "frequency": "every-3-years", "description": "Serum calcium screening", "reminderDays": 3 },
      { "title": "Rheumatoid Factor Test", "age": 40, "frequency": "every-5-years", "description": "Screening for autoimmune arthritis (if symptoms)", "reminderDays": 7 }
    ]
  },
  {
    "category": "Dental",
    "subEvents": [
      { "title": "Dental Checkup & Cleaning", "age": 18, "frequency": "semiannual", "description": "Routine dental examination and professional cleaning", "reminderDays": 3 },
      { "title": "Dental X-rays", "age": 18, "frequency": "yearly", "description": "Annual dental radiographs", "reminderDays": 3 },
      { "title": "Periodontal Evaluation", "age": 30, "frequency": "yearly", "description": "Gum health assessment", "reminderDays": 3 },
      { "title": "Oral Cancer Screening", "age": 18, "frequency": "semiannual", "description": "Screening during dental visits", "reminderDays": 3 }
    ]
  },
  {
    "category": "Vision & Hearing",
    "subEvents": [
      { "title": "Comprehensive Eye Exam", "age": 18, "frequency": "every-2-years", "description": "Full eye examination", "reminderDays": 7 },
      { "title": "Eye Exam (Annual 65+)", "age": 65, "frequency": "yearly", "description": "Annual eye exam for seniors", "reminderDays": 7 },
      { "title": "Glaucoma Screening", "age": 40, "frequency": "every-2-years", "description": "Screening for glaucoma", "reminderDays": 7 },
      { "title": "Macular Degeneration Screening", "age": 50, "frequency": "every-2-years", "description": "Age-related macular degeneration check", "reminderDays": 7 },
      { "title": "Diabetic Eye Exam", "age": 30, "frequency": "yearly", "description": "Dilated eye exam for diabetics", "reminderDays": 7 },
      { "title": "Hearing Test", "age": 18, "frequency": "every-10-years", "description": "Baseline hearing screening", "reminderDays": 3 },
      { "title": "Hearing Test (50+)", "age": 50, "frequency": "every-3-years", "description": "Regular hearing screening for adults 50+", "reminderDays": 3 }
    ]
  },
  {
    "category": "Infectious Disease Screening",
    "subEvents": [
      { "title": "STI Screening", "age": 18, "maxAge": 65, "frequency": "yearly", "description": "Sexually transmitted infection screening (if sexually active)", "reminderDays": 3 },
      { "title": "HIV Screening", "age": 18, "maxAge": 65, "frequency": "yearly", "description": "HIV antibody test (recommended for all adults)", "reminderDays": 7 },
      { "title": "Hepatitis C Screening", "age": 18, "frequency": "once", "description": "One-time screening for all adults", "reminderDays": 7 },
      { "title": "Tuberculosis Screening", "age": 18, "frequency": "every-5-years", "description": "TB skin test or blood test (if at risk)", "reminderDays": 3 }
    ]
  },
  {
    "category": "Mental Health",
    "subEvents": [
      { "title": "Depression Screening", "age": 18, "frequency": "yearly", "description": "Annual mental health screening", "reminderDays": 3 },
      { "title": "Anxiety Screening", "age": 18, "frequency": "yearly", "description": "Generalized anxiety disorder screening", "reminderDays": 3 },
      { "title": "Cognitive Assessment", "age": 65, "frequency": "yearly", "description": "Cognitive function screening for seniors", "reminderDays": 7 },
      { "title": "Dementia Screening", "age": 70, "frequency": "yearly", "description": "Memory and cognitive decline assessment", "reminderDays": 7 },
      { "title": "Alcohol Use Screening", "age": 18, "frequency": "yearly", "description": "Screening for alcohol misuse", "reminderDays": 3 },
      { "title": "Substance Abuse Screening", "age": 18, "frequency": "yearly", "description": "Drug use and dependency screening", "reminderDays": 3 }
    ]
  },
  {
    "category": "Liver & Kidney Health",
    "subEvents": [
      { "title": "Liver Function Test", "age": 40, "frequency": "every-3-years", "description": "Hepatic panel screening (ALT, AST, bilirubin)", "reminderDays": 3 },
      { "title": "Kidney Function Test", "age": 40, "frequency": "every-3-years", "description": "Renal function screening (creatinine, GFR)", "reminderDays": 3 },
      { "title": "Urine Protein Test", "age": 50, "frequency": "yearly", "description": "Screening for kidney disease", "reminderDays": 3 },
      { "title": "Fatty Liver Screening", "age": 40, "frequency": "every-5-years", "description": "Ultrasound or FibroScan (if at risk)", "reminderDays": 7 }
    ]
  },
  {
    "category": "Blood & Immune System",
    "subEvents": [
      { "title": "Complete Blood Count", "age": 18, "frequency": "yearly", "description": "Annual CBC blood test", "reminderDays": 3 },
      { "title": "Iron Level & Ferritin", "age": 18, "frequency": "every-3-years", "description": "Screening for anemia and iron deficiency", "reminderDays": 3 },
      { "title": "B12 Level", "age": 50, "frequency": "every-3-years", "description": "Vitamin B12 screening", "reminderDays": 3 },
      { "title": "Folate Level", "age": 40, "frequency": "every-5-years", "description": "Folic acid screening", "reminderDays": 3 },
      { "title": "C-Reactive Protein (CRP)", "age": 40, "frequency": "every-5-years", "description": "Inflammation marker", "reminderDays": 7 },
      { "title": "Homocysteine Level", "age": 50, "frequency": "every-5-years", "description": "Cardiovascular risk marker", "reminderDays": 7 }
    ]
  },
  {
    "category": "Hormonal Health",
    "subEvents": [
      { "title": "Testosterone Level (Men)", "age": 40, "frequency": "every-5-years", "description": "Testosterone screening for men", "reminderDays": 7 },
      { "title": "Estrogen Level (Women)", "age": 40, "frequency": "every-5-years", "description": "Estrogen screening for perimenopausal women", "reminderDays": 7 },
      { "title": "Cortisol Level", "age": 35, "frequency": "every-5-years", "description": "Stress hormone screening", "reminderDays": 7 },
      { "title": "DHEA-S Level", "age": 40, "frequency": "every-5-years", "description": "Adrenal function assessment", "reminderDays": 7 }
    ]
  },
  {
    "category": "Reproductive Health",
    "subEvents": [
      { "title": "Pelvic Exam", "age": 18, "frequency": "yearly", "description": "Annual gynecological exam for women", "reminderDays": 7 },
      { "title": "Testicular Exam", "age": 18, "frequency": "yearly", "description": "Testicular examination for men", "reminderDays": 3 },
      { "title": "Mammogram", "age": 40, "frequency": "yearly", "description": "Breast cancer screening", "reminderDays": 7 },
      { "title": "Breast Self-Exam Education", "age": 20, "frequency": "yearly", "description": "Annual reminder for monthly self-exams", "reminderDays": 3 },
      { "title": "Prostate Exam", "age": 50, "frequency": "yearly", "description": "Digital rectal exam for men", "reminderDays": 7 }
    ]
  },
  {
    "category": "Age-Specific Health",
    "subEvents": [
      { "title": "Medication Review", "age": 65, "frequency": "yearly", "description": "Annual review of all medications with pharmacist/doctor", "reminderDays": 7 },
      { "title": "Fall Risk Assessment", "age": 65, "frequency": "yearly", "description": "Balance and fall prevention screening", "reminderDays": 3 },
      { "title": "Nutrition Counseling", "age": 65, "frequency": "yearly", "description": "Dietary assessment and counseling", "reminderDays": 3 },
      { "title": "Advance Care Planning", "age": 65, "frequency": "every-5-years", "description": "Discussion of advance directives and health care wishes", "reminderDays": 14 },
      { "title": "Functional Assessment", "age": 70, "frequency": "yearly", "description": "Activities of daily living evaluation", "reminderDays": 7 },
      { "title": "Home Safety Evaluation", "age": 70, "frequency": "every-5-years", "description": "Assessment of home for safety hazards", "reminderDays": 7 }
    ]
  },
  {
    "category": "Preventive Lab Work",
    "subEvents": [
      { "title": "Metabolic Panel", "age": 18, "frequency": "yearly", "description": "Comprehensive metabolic panel", "reminderDays": 3 },
      { "title": "Magnesium Level", "age": 40, "frequency": "every-3-years", "description": "Magnesium screening", "reminderDays": 3 },
      { "title": "Uric Acid Level", "age": 40, "frequency": "every-5-years", "description": "Gout and kidney function marker", "reminderDays": 3 },
      { "title": "Coagulation Panel", "age": 60, "frequency": "every-5-years", "description": "Blood clotting factors (PT/INR, PTT)", "reminderDays": 7 },
      { "title": "Omega-3 Index", "age": 40, "frequency": "every-3-years", "description": "Essential fatty acid levels", "reminderDays": 7 }
    ]
  },
  {
    "category": "Lifestyle & Wellness",
    "subEvents": [
      { "title": "Personal Health Goals Review", "age": 18, "frequency": "yearly", "description": "Annual review of health and wellness goals", "reminderDays": 7 },
      { "title": "Health Insurance Review", "age": 18, "frequency": "yearly", "description": "Annual review of insurance coverage", "reminderDays": 14 },
      { "title": "Immunization Record Update", "age": 18, "frequency": "yearly", "description": "Update and review vaccination records", "reminderDays": 3 },
      { "title": "Sleep Quality Assessment", "age": 40, "frequency": "every-3-years", "description": "Sleep disorder screening", "reminderDays": 3 },
      { "title": "Physical Fitness Assessment", "age": 18, "frequency": "yearly", "description": "Exercise capacity and fitness level evaluation", "reminderDays": 7 },
      { "title": "BMI and Body Composition", "age": 18, "frequency": "yearly", "description": "Weight and body composition assessment", "reminderDays": 3 }
    ]
  }
]
```
