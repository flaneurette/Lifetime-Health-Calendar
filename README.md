

## Lifetime Health Calendar Generator

The **Lifetime Health Calendar Generator** creates a personalized medical checkup calendar starting from today and extending up to 90 years of age. You enter your birth date, select the health screenings and reminders that apply to you, and the tool generates a standards-compliant **`.ics` calendar file**. This file can be imported into most calendar systems, including mobile phones, desktop calendars, and email-based calendars.

### Possible limitations.

- Google calendar might not import any event beyond 2036, due to 32-bit Unix time issues.
- The maximum filesize generated is around: 512kb for 90 years, some software might find that calendar too big (rare, but possible)
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
* The more screenings you enable, the larger the calendar becomes
* Some years may contain multiple events on the same day if many checks are selected
* Only select medical screenings that apply to your situation

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
