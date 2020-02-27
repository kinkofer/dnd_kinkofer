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

            div#finalCompendiumDiv {
                border: 2px solid;
                background-color: beige;
                margin: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title">
                    Create a Compendium
                </div>

                <div id="finalCompendiumDiv" style="display: none;">
                    <p>
                        Your Compendium has been created.<br />
                        <a href="javascript:void(0)">Click here to download.</a>
                    <p>
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
                            <input type="checkbox" id="coreRulebooks" name="sources[]" value="CoreRulebooks" />
                            <label for="coreRulebooks">Core Rulebooks</label>
                        </div>

                        <hr />

                        <h3>Rulebook Supplements</h3>
                        <div class="quickSelect">
                            <a href="javascript:void(0)">Select All</a>
                        </div>

                        <div class="checkbox">
                            <input type="checkbox" id="xanatharsGuideToEverything" name="sources[]" value="XanatharsGuideToEverything" />
                            <label for="xanatharsGuideToEverything">Xanathar's Guide To Everything</label>
                        </div>
                        <div class="checkbox">
                            <input type="checkbox" id="mordenkainensTomeOfFoes" name="sources[]" value="MordenkainensTomeOfFoes" />
                            <label for="mordenkainensTomeOfFoes">Mordenkainen's Tome of Foes</label>
                        </div>
                        <div class="checkbox">
                            <input type="checkbox" id="volosGuideToMonsters" name="sources[]" value="VolosGuideToMonsters" />
                            <label for="volosGuideToMonsters">Volo's Guide to Monsters</label>
                        </div>

                        <hr />

                        <h3>Adventurues</h3>
                        <div class="quickSelect">
                            <a href="javascript:void(0)">Select All</a>
                        </div>

                        <hr />

                        <h3>Unearthed Arcana</h3>
                        <div class="quickSelect">
                            <a href="javascript:void(0)">Select All</a>
                            <a href="javascript:void(0)">Select Unreleased</a>
                        </div>


                        <hr />

                        <h3>Homebrew</h3>
                        <div class="quickSelect">
                            <a href="javascript:void(0)">Select All</a>
                        </div>


                        <hr />

                        <h3>Third Party</h3>
                        <div class="quickSelect">
                            <a href="javascript:void(0)">Select All</a>
                        </div>

                        <input type="submit" value="Create">
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
