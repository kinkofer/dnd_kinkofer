<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Create a Compendium</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                /*height: 100vh;*/
                margin: 0;
            }

            .full-height {
                /*height: 100vh;*/
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            div.checkbox {
                text-align: left;
            }

            div.quickSelect {
                margin-top: -25px;
            }

            div.quickSelect > a {
                font-size: 10px;
                text-decoration: none;
                border-bottom: 1px dotted;
                margin-right: 0;
            }

            div.quickSelect > a:link, a:visited {
                color: gray;
            }

            div.quickSelect > a:hover, a:active {
                color: navy;
            }

            ul#precompiledCompendiumList {
                text-align: left;
            }

            ul#precompiledCompendiumList p {
                display: inline;
            }

            div#customCompendiumDiv {
                border: 2px solid;
                background-color: beige;
                margin: 30px;
            }

            #footnote {
                font-size: 10px;
                margin: 30px;
            }
        </style>

        <script>
            function requirePHB(checkbox) {
                if (checkbox.checked) {
                    var phbCheckbox = document.getElementById('coreRulebooks');

                    if (!phbCheckbox.checked) {
                        phbCheckbox.checked = true;
                        let changeEvent = new Event('change');
                        phbCheckbox.dispatchEvent(changeEvent);
                    }
                }
            }

            function uncheckPHBRequiredSources() {
                var phbCheckbox = document.getElementById('coreRulebooks');
                if (!phbCheckbox.checked) {
                    var checkboxes = document.getElementsByClassName('requiresPHB');
                    var i;
                    for (i = 0; i < checkboxes.length; i++) {
                        if (checkboxes[i].checked) {
                            checkboxes[i].checked = false;
                            let changeEvent = new Event('change');
                            checkboxes[i].dispatchEvent(changeEvent);
                        }
                    }
                }
            }

            function requireXgtE(checkbox) {
                if (checkbox.checked) {
                    var xgteCheckbox = document.getElementById('xanatharsGuideToEverything');
                    
                    if (!xgteCheckbox.checked) {
                        xgteCheckbox.checked = true;
                        let changeEvent = new Event('change');
                        xgteCheckbox.dispatchEvent(changeEvent);
                    }
                }
            }

            function uncheckXgtERequiredSources() {
                var xgteCheckbox = document.getElementById('xanatharsGuideToEverything');
                if (!xgteCheckbox.checked) {
                    var checkboxes = document.getElementsByClassName('requiresXgtE');
                    var i;
                    for (i = 0; i < checkboxes.length; i++) {
                        if (checkboxes[i].checked) {
                            checkboxes[i].checked = false;
                            let changeEvent = new Event('change');
                            checkboxes[i].dispatchEvent(changeEvent);
                        }
                    }
                }
            }

            function selectAll(className) {
                var checkboxes = document.getElementsByClassName(className);
                var i;
                    for (i = 0; i < checkboxes.length; i++) {
                        if (!checkboxes[i].checked) {
                            checkboxes[i].checked = true;
                            let changeEvent = new Event('change');
                            checkboxes[i].dispatchEvent(changeEvent);
                        }
                    }
            }
        </script>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title">
                    Create a Compendium
                </div>

                <div id="customCompendiumDiv" style="display: {{ isset($customCompendium) ? 'block' : 'none' }};">
                    <p>
                        Your Compendium has been created.<br />
                        <a href="{{ $customCompendium ?? 'javascript:void(0)' }}"{{ isset($customCompendium) ? ' download' : '' }}>Click here to download.</a>
                    <p>
                </div>

                <div>
                    <p>
                        Import a D&D compendium into the Fight Club 5e and Game Master 5e app.<br />
                        <i>This site is not affiliated with WotC or Lion's Den.</i>
                    </p>
                </div>

                <div>
                    <p>Select a pre-compiled compendium here or create your own below.</p>
                    <ul id="precompiledCompendiumList">
                        <li>
                            <a href="/compendiums/collections/CoreRulebooks.xml" download>Core Rulebooks</a>:
                            <p>Player's Handbook, Dungeon Master's Guide, and Monster Manual</p>
                        </li>
                        <li>
                            <a href="/compendiums/collections/CoreRulebooksAndSupplements.xml" download>Core Rulebooks and Supplements</a>:
                            <p>
                                <b>Core Rulebooks</b> plus Rulebook Supplements<br />
                                (XGtE, MToF, VGtM, SCAG, GGtR, WGtE, ERftLW, AI, MFF, Tortle Package, and One Grung Above)
                            </p>
                        </li>
                        <li>
                            <a href="/compendiums/collections/CoreOnly.xml" download>Core Only</a>:
                            <p>
                                <b>Core Rulebooks and Supplements</b> plus Adventures
                            </p>
                        </li>
                        <li>
                            <a href="/compendiums/collections/CorePlusHomebrew-NoUA.xml" download>Core Plus Homebrew (No UA)</a>:
                            <p>
                                <b>Core Only</b> plus homebrew, which includes the Blood Hunter class and Gunslinger subclass for Fighter
                            </p>
                        </li>
                        <li>
                            <a href="/compendiums/collections/CorePlusUnreleasedUA.xml" download>Core Plus Unreleased UA</a>:
                            <p>
                                <b>Core Only</b> plus unreleased Unearthed Arcana (No Homebrew)
                            </p>
                        </li>
                        <li>
                            <a href="/compendiums/collections/CorePlusUA-NoHomebrew.xml" download>Core Plus All UA</a>:
                            <p>
                                <b>Core Only</b> plus all Unearthed Arcana (No Homebrew)
                            </p>
                        </li>
                        <li>
                            <a href="/compendiums/collections/Complete.xml" download>Complete</a>:
                            <p>
                                <b>Core Plus All UA</b> plus homebrew and third party content
                            </p>
                        </li>
                    </ul>
                </div>

                <div>
                    <form method="POST" action="/compendium">
                        @method('POST')
                        @csrf
                        <h3>Core Rulebooks</h3>

                        <div class="checkbox">
                            <input type="checkbox" id="coreRulebooks" name="sources[]" value="CoreRulebooks" onChange="uncheckPHBRequiredSources()" />
                            <label for="coreRulebooks">Core Rulebooks (PHB, DMG, MM)</label>
                        </div>

                        <hr />

                        <h3>Rulebook Supplements</h3>
                        <div class="quickSelect">
                            <a href="javascript:void(0)" onClick="selectAll('rulebookSupplements')">Select All</a>
                        </div>

                        <div class="checkbox">
                            <input type="checkbox" id="xanatharsGuideToEverything" name="sources[]" value="XanatharsGuideToEverything" onChange="requirePHB(this); uncheckXgtERequiredSources();" class="requiresPHB rulebookSupplements" />
                            <label for="xanatharsGuideToEverything">Xanathar's Guide To Everything</label>&#x2A
                        </div>
                        <div class="checkbox">
                            <input type="checkbox" id="mordenkainensTomeOfFoes" name="sources[]" value="MordenkainensTomeOfFoes" class="rulebookSupplements" />
                            <label for="mordenkainensTomeOfFoes">Mordenkainen's Tome of Foes</label>
                        </div>
                        <div class="checkbox">
                            <input type="checkbox" id="volosGuideToMonsters" name="sources[]" value="VolosGuideToMonsters" class="rulebookSupplements" />
                            <label for="volosGuideToMonsters">Volo's Guide to Monsters</label>
                        </div>
                        <div class="checkbox">
                            <input type="checkbox" id="swordCoastAdventurersGuide" name="sources[]" value="SwordCoastAdventurersGuide" onChange="requireXgtE(this)" class="requiresXgtE rulebookSupplements" />
                            <label for="swordCoastAdventurersGuide">Sword Coast Adventurer's Guide</label>&#x2020
                        </div>
                        <div class="checkbox">
                            <input type="checkbox" id="guildmastersGuideToRavnica" name="sources[]" value="GuildmastersGuideToRavnica" onChange="requirePHB(this)" class="requiresPHB rulebookSupplements" />
                            <label for="guildmastersGuideToRavnica">Guildmaster's Guide to Ravnica</label>&#x2A
                        </div>
                        <div class="checkbox">
                            <input type="checkbox" id="wayfindersGuideToEberron" name="sources[]" value="WayfindersGuideToEberron" class="rulebookSupplements" />
                            <label for="wayfindersGuideToEberron">Wayfinder's Guide to Eberron</label>
                            <sup>(Item's Only)</sup>
                        </div>
                        <div class="checkbox">
                            <input type="checkbox" id="eberronRisingFromTheLastWar" name="sources[]" value="EberronRisingFromTheLastWar" onChange="requireXgtE(this)" class="requiresXgtE rulebookSupplements" />
                            <label for="eberronRisingFromTheLastWar">Eberron: Rising from the Last War</label>&#x2020
                        </div>
                        <div class="checkbox">
                            <input type="checkbox" id="acquisitionsIncorporated" name="sources[]" value="AcquisitionsIncorporated" class="rulebookSupplements" />
                            <label for="acquisitionsIncorporated">Acquisitions Incorporated</label>
                        </div>
                        <div class="checkbox">
                            <input type="checkbox" id="mordenkainensFiendishFolio" name="sources[]" value="MordenkainensFiendishFolio" class="rulebookSupplements" />
                            <label for="mordenkainensFiendishFolio">Mordenkainen's Fiendish Folio</label>
                        </div>
                        <div class="checkbox">
                            <input type="checkbox" id="theTortlePackage" name="sources[]" value="The Tortle Package" class="rulebookSupplements" />
                            <label for="theTortlePackage">The Tortle Package</label>
                        </div>
                        <div class="checkbox">
                            <input type="checkbox" id="oneGrungAbove" name="sources[]" value="One Grung Above" class="rulebookSupplements" />
                            <label for="oneGrungAbove">One Grung Above</label>
                        </div>

                        <hr />

                        <h3>Adventurues</h3>
                        <div class="quickSelect">
                            <a href="javascript:void(0)" onClick="selectAll('adventures')">Select All</a>
                        </div>

                        <div class="checkbox">
                            <input type="checkbox" id="adventures" name="sources[]" value="Adventures" onChange="requireXgtE(this)" class="requiresXgtE adventures" />
                            <label for="adventures">Adventures (CoS, GoS, HotDQ, LMoP, OotA, PotA, RoT, SKT, TftYP, ToA, WDH, WDotMM)</label>&#x2020
                        </div>
                        <div class="checkbox">
                            <input type="checkbox" id="baldursGateDescentIntoAvernus" name="sources[]" value="BaldursGateDescentIntoAvernus" class="adventures" />
                            <label for="baldursGateDescentIntoAvernus">Baldur's Gate: Descent Into Avernus</label>
                        </div>
                        <div class="checkbox">
                            <input type="checkbox" id="divineContention" name="sources[]" value="DivineContention" class="adventures" />
                            <label for="divineContention">Divine Contention</label>
                        </div>
                        <div class="checkbox">
                            <input type="checkbox" id="dragonOfIcespirePeak" name="sources[]" value="DragonOfIcespirePeak" class="adventures" />
                            <label for="dragonOfIcespirePeak">Dragon of Icespire Peak</label>
                        </div>
                        <div class="checkbox">
                            <input type="checkbox" id="huntForTheThesselhydra" name="sources[]" value="HuntForTheThesselhydra" class="adventures" />
                            <label for="huntForTheThesselhydra">Hunt for the Thesselhydra</label>
                        </div>
                        <div class="checkbox">
                            <input type="checkbox" id="infernalMachineRebuild" name="sources[]" value="InfernalMachineRebuild" class="adventures" />
                            <label for="infernalMachineRebuild">Infernal Machine Rebuild</label>
                        </div>
                        <div class="checkbox">
                            <input type="checkbox" id="locathahRising" name="sources[]" value="LocathahRising" class="adventures" />
                            <label for="locathahRising">Locathah Rising</label>
                        </div>
                        <div class="checkbox">
                            <input type="checkbox" id="lostLaboratoryOfKwalish" name="sources[]" value="LostLaboratoryOfKwalish" class="adventures" />
                            <label for="lostLaboratoryOfKwalish">Lost Laboratory of Kwalish</label>
                        </div>
                        <div class="checkbox">
                            <input type="checkbox" id="sleepingDragonsWake" name="sources[]" value="SleepingDragonsWake" class="adventures" />
                            <label for="sleepingDragonsWake">Sleeping Dragons Wake</label>
                        </div>
                        <div class="checkbox">
                            <input type="checkbox" id="stormLordsWrath" name="sources[]" value="StormLordsWrath" class="adventures" />
                            <label for="stormLordsWrath">Storm Lord's Wrath</label>
                        </div>

                        <hr />

                        <h3>Unearthed Arcana</h3>
                        <div class="quickSelect">
                            <a href="javascript:void(0)" onClick="selectAll('unearthedArcana')">Select All</a>
                            <a href="javascript:void(0)" onClick="selectAll('unreleased')">Select Unreleased</a>
                        </div>

                        <div class="checkbox">
                            <input type="checkbox" id="unearthedArcana" name="sources[]" value="UnearthedArcana/UnearthedArcana" onChange="requireXgtE(this)" class="unearthedArcana requiresXgtE" />
                            <label for="unearthedArcana">Unearthed Arcana</label>&#x2020
                            <sup>Released</sup>
                        </div>
                        <div class="checkbox">
                            <input type="checkbox" id="2015-08-03_ModernMagic" name="sources[]" value="UnearthedArcana/2015-08-03_ModernMagic" onChange="requirePHB(this)" class="unearthedArcana unreleased requiresPHB" />
                            <label for="2015-08-03_ModernMagic">2015-08-03 Modern Magic</label>&#x2A&#xA7
                        </div>
                        <div class="checkbox">
                            <input type="checkbox" id="2017-01-09_Artificer" name="sources[]" value="UnearthedArcana/2017-01-09_Artificer" onChange="requirePHB(this)" class="unearthedArcana requiresPHB" />
                            <label for="2017-01-09_Artificer">2017-01-09 Artificer</label>&#x2A
                        </div>
                        <div class="checkbox">
                            <input type="checkbox" id="2017-03-03_TheMysticClass" name="sources[]" value="UnearthedArcana/2017-03-03_TheMysticClass" onChange="requirePHB(this)" class="unearthedArcana unreleased requiresPHB" />
                            <label for="2017-03-03_TheMysticClass">2017-03-03 The Mystic Class</label>&#x2A&#xA7
                        </div>
                        <div class="checkbox">
                            <input type="checkbox" id="2018-12-17_Sidekicks" name="sources[]" value="UnearthedArcana/2018-12-17_Sidekicks" onChange="requirePHB(this)" class="unearthedArcana unreleased requiresPHB" />
                            <label for="2018-12-17_Sidekicks">2018-12-17 Sidekicks</label>&#x2A&#xA7
                        </div>
                        <div class="checkbox">
                            <input type="checkbox" id="2019-08-15_BarbarianAndMonk" name="sources[]" value="UnearthedArcana/2019-08-15_BarbarianAndMonk" onChange="requirePHB(this)" class="unearthedArcana unreleased requiresPHB" />
                            <label for="2019-08-15_BarbarianAndMonk">2019-08-15 Barbarian and Monk</label>&#x2A&#xA7
                        </div>
                        <div class="checkbox">
                            <input type="checkbox" id="2019-09-05_SorcererAndWarlock" name="sources[]" value="UnearthedArcana/2019-09-05_SorcererAndWarlock" onChange="requirePHB(this)" class="unearthedArcana unreleased requiresPHB" />
                            <label for="2019-09-05_SorcererAndWarlock">2019-09-05 Sorcerer and Warlock</label>&#x2A&#xA7
                        </div>
                        <div class="checkbox">
                            <input type="checkbox" id="2019-09-18_BardAndPaladin" name="sources[]" value="UnearthedArcana/2019-09-18_BardAndPaladin" onChange="requirePHB(this)" class="unearthedArcana unreleased requiresPHB" />
                            <label for="2019-09-18_BardAndPaladin">2019-09-18 Bard and Paladin</label>&#x2A&#xA7
                        </div>
                        <div class="checkbox">
                            <input type="checkbox" id="2019-10-03_ClericDruidAndWizard" name="sources[]" value="UnearthedArcana/2019-10-03_ClericDruidAndWizard" onChange="requirePHB(this)" class="unearthedArcana unreleased requiresPHB" />
                            <label for="2019-10-03_ClericDruidAndWizard">2019-10-03 Cleric Druid and Wizard</label>&#x2A&#xA7
                        </div>
                        <div class="checkbox">
                            <input type="checkbox" id="2019-10-17_FighterRangerAndRogue" name="sources[]" value="UnearthedArcana/2019-10-17_FighterRangerAndRogue" onChange="requirePHB(this)" class="unearthedArcana unreleased requiresPHB" />
                            <label for="2019-10-17_FighterRangerAndRogue">2019-10-17 Fighter Ranger and Rogue</label>&#x2A&#xA7
                        </div>
                        <div class="checkbox">
                            <input type="checkbox" id="2019-11-04_ClassFeatureVariants" name="sources[]" value="UnearthedArcana/2019-11-04_ClassFeatureVariants" onChange="requireXgtE(this)" class="unearthedArcana unreleased requiresXgtE" />
                            <label for="2019-11-04_ClassFeatureVariants">2019-11-04 Class Feature Variants</label>&#x2020&#xA7
                        </div>
                        <div class="checkbox">
                            <input type="checkbox" id="2019-11-25_FighterRogueAndWizard" name="sources[]" value="UnearthedArcana/2019-11-25_FighterRogueAndWizard" onChange="requirePHB(this)" class="unearthedArcana unreleased requiresPHB" />
                            <label for="2019-11-25_FighterRogueAndWizard">2019-11-25 Fighter Rogue and Wizard</label>&#x2A&#xA7
                        </div>
                        <div class="checkbox">
                            <input type="checkbox" id="2020-01-14_2020SubclassesPart1" name="sources[]" value="UnearthedArcana/2020-01-14_2020SubclassesPart1" onChange="requirePHB(this)" class="unearthedArcana unreleased requiresPHB" />
                            <label for="2020-01-14_2020SubclassesPart1">2020-01-14 2020 Subclasses Part 1</label>&#x2A&#xA7
                        </div>
                        <div class="checkbox">
                            <input type="checkbox" id="2020-02-04_2020SubclassesPart2" name="sources[]" value="UnearthedArcana/2020-02-04_2020SubclassesPart2" onChange="requirePHB(this)" class="unearthedArcana unreleased requiresPHB" />
                            <label for="2020-02-04_2020SubclassesPart2">2020-02-04 2020 Subclasses Part 2</label>&#x2A&#xA7
                        </div>

                        <hr />

                        <h3>Homebrew</h3>
                        <div class="quickSelect" onClick="selectAll('homebrew')">
                            <a href="javascript:void(0)">Select All</a>
                        </div>

                        <div class="checkbox">
                            <input type="checkbox" id="homebrew" name="sources[]" value="Homebrew" onChange="requirePHB(this)" class="homebrew requiresPHB" />
                            <label for="homebrew">Homebrew</label>&#x2A
                        </div>


                        <hr />

                        <h3>Third Party</h3>
                        <div class="quickSelect">
                            <a href="javascript:void(0)" onClick="selectAll('thirdParty')">Select All</a>
                        </div>

                        <div class="checkbox">
                            <input type="checkbox" id="tomeOfBeasts" name="sources[]" value="ThirdParty/TomeOfBeasts" class="thirdParty" />
                            <label for="tomeOfBeasts">Tome of Beasts</label>
                        </div>
                        <div class="checkbox">
                            <input type="checkbox" id="creatureCodex" name="sources[]" value="ThirdParty/CreatureCodex" class="thirdParty" />
                            <label for="creatureCodex">Creature Codex</label>
                        </div>

                        <hr />

                        <input type="submit" value="Create">


                        <p id="footnote">
                            &#x2A Requires Player's Handbook<br />
                            &#x2020 Requires Xanathar's Guide to Everything<br />
                            &#xA7 Unreleased
                            <!-- 
                                &#x2A (asterisk)
                                &#x2020 (dagger)
                                &#x2021 (double dagger) 
                                &#xA7 (section symbol)
                            -->
                        </p>

                        
                        <div style="margin-bottom: 50px;"></div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
