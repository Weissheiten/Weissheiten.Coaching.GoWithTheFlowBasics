Weissheiten.Coaching.GoWithTheFlowBasics |version| Documentation
==================================================================================================

This documentation covering version |release| has been rendered at: |today|

Introduction
------------
The code base to go along with the "Go with the Flow - Flow Basics by example" tutorial.
Over the various commits we will build a package that provides WirelessAuthentication codes via JSON that have been preloaded into the database from a CSV.
They can be queried one at a time to be printed in a local outlet via a dektop application that connects to the receipt printer,
so guests can be provided with an access code on demand.

This package covers a good amount of the "Flow Basics" SkillPackage provided on SkillDisplay, so you'll be able to track your own progress while following this tutorial via SkillUps! for the according package at https://www.skilldisplay.at!
The "Flow Basics" SkillPackage was generated in cooperation with the Neos Evangelist Christian Müller (@daskitsunet)

More information can be found at

* https://www.neos.io/
* https://docs.readthedocs.org/en/latest/getting_started.html#in-rst
* https://www.skilldisplay.at/
* http://www.weissheiten.at/

Versions
---------
Version     Videos      Content
0.1         00 to 05    Initial package with readme
0.2         06          introduce first draft of command controller for inserting Wifi vouchers
0.3         07 to 08    introduce voucher model
0.4         09          introduce repository, inject repository in commandcontroller, generate migration for database
0.5         10          mark repository as singleton, introduce new commandcontroller functions for voucher administration