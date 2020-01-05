<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/templates/_functions.php');

//Change page name here:
$PageName = 'Working Baseline';

require_once($_SERVER['DOCUMENT_ROOT'].'/templates/_header.php');
?>

    <div id="Content">
<!-- ----------------------------------------- Content starts here ------------------------------------------------ -->


		<!-- =============== Diagram =============== -->
		<div class="imageblock" style="text-align: center">
		  <img src="/openehr_block_diagram3.svg" alt="openEHR Components" width="45%">
		</div>

        <div class="specs_category_box" style="background-color: #C6F0FA;">
			<!-- =============== Conformance Specs =============== -->
			<div id="global_group">
                <p class="group_title">Start Here</p>
				<div class="group_box">
					<div id="global_row" class="component_row">
                        <div class="specs_cell" style="background-color:#ffeecc; border-left:none; flex-flow: row;">                        
                            <p class="specs_item_wide">
                                <a href="/releases/BASE/latest/architecture_overview.html" target="_blank">Architecture Overview</a><br>Global description of openEHR design principles and architecture
                            </p>
                            <p class="specs_item_wide">
                                <a href="/releases/AM/latest/Overview.html" target="_blank">Archetype Technology</a><br>Business case for archetyping; overview of archetype specifications
                            </p>
                            <p class="specs_item_wide">
                                <a href="https://openehr.atlassian.net/wiki/spaces/spec/pages/357957633/Services+Landscape+for+e-Health" target="_blank">Services Landscape</a><br>Map of e-health services at enterprise, community and region levels
                            </p>
                            <p class="specs_item">
                                <a href="/releases/UML/latest" target="_blank">GLOBAL UML</a><br>Generated global UML website
                            </p>
                            <p class="specs_item">
                                <a href="/releases/AA_GLOBAL/latest/index.html" target="_blank">CLASS INDEX</a><br>Global openEHR class link list
                            </p>
                        </div>
					</div>
                </div>
            </div>
        </div>

		<div class="specs_category_box">
			<!-- =============== Conformance Specs =============== -->
			<div id="cnf_group">
                <p class="group_title">Conformance</p>
				<div class="group_box">
					<div id="cnf_row" class="component_row">
                        <div class="component_cell">
                            <p class="component_name">
                                <a id="CNF"></a>
                                <a href="/releases/CNF/latest/index" target="_blank">CNF</a>
                            </p>
                            <p>(Conformance)</p>
                            <p>
                                <a href="/components/CNF/open_issues" target="_blank">PRs</a> | <a href="https://openehr.atlassian.net/projects/SPECCNF?orderField=RANK&selectedItem=com.atlassian.jira.jira-projects-plugin%3Arelease-page&status=released-unreleased" target="_blank">CRs</a>
                            </p>
                        </div>
                        
                        <div class="specs_cell" style="background-color:white;">                        
                            <p class="specs_item_wide">
                                <a href="/releases/CNF/latest/openehr_platform_conformance.html" target="_blank">Platform Conformance</a><br>System Under Test (SUT), Conformance Schedule, Profiles, Certification
                            </p>
                        </div>
                        
						<p class="releases">
						</p>
					</div>
                </div>
            </div>
            
			<!-- =============== ITS Specs =============== -->
			<div id="its_group">
                <p class="group_title">Implementation Technologies</p>
				<div class="group_box">
                    <div id="its_row" class="component_row">
                        <div class="component_cell">
                            <p id="ITS" class="component_name">
                                <a href="/releases/ITS/latest/index" target="_blank">ITS</a>
                            </p>
                            <p>(Implementation<br>Technologies)</p>
                            <p>
                                <a href="/components/ITS/open_issues" target="_blank">PRs</a> | <a href="https://openehr.atlassian.net/projects/SPECITS?orderField=RANK&selectedItem=com.atlassian.jira.jira-projects-plugin%3Arelease-page&status=released-unreleased" target="_blank">CRs</a>
                            </p>
                        </div>

                        <div class="specs_cell" style="background-color:#F2D5F4;">
                            <p class="specs_item">
                                <a href="/releases/ITS-REST/latest/index.html" target="_blank">REST APIs</a><br>
                                <a href="/releases/ITS-REST/latest/ehr.html" target="_blank">EHR</a>, 
                                <a href="/releases/ITS-REST/latest/query.html" target="_blank">Query</a>,
                                <a href="/releases/ITS-REST/latest/definitions.html" target="_blank">Definitions</a>
                            </p>
                            <p class="specs_item">
                                <a href="/releases/ITS-REST/latest/simplified_data_template.html" target="_blank">SDT</a><br>Simplified Data Template
                            </p>
                            <p class="specs_item">
                                <a href="https://github.com/openEHR/specifications-ITS-XML" target="_blank">XSDs</a><br>XML Schemas for the openEHR RM and AM
                            </p>
                            <p class="specs_item">
                                <a href="https://github.com/openEHR/specifications-ITS-JSON" target="_blank">JSON schema</a><br>JSON Schemas for the openEHR RM and AM
                            </p>
                            <p class="specs_item">
                                <a href="https://github.com/openEHR/specifications-ITS-BMM" target="_blank">BMMs</a><br>BMM schemas for Task Planning, RM, Expressions, BASE
                            </p>
                        </div>

                        <p class="releases">
                            <a href="https://openehr.atlassian.net/browse/SPECITS/fixforversion/12522" target="_blank">JSON 1.0.0</a> (cooking) <br>
                            <a href="https://openehr.atlassian.net/projects/SPECITS/versions/12520/tab/release-report-all-issues" target="_blank">XML 2.0.0</a> (cooking) <br>
                            <a href="https://openehr.atlassian.net/projects/SPECITS/versions/12529/tab/release-report-all-issues" target="_blank">REST 1.1.0</a> (cooking) <br>
                            <a href="/releases/ITS-REST/Release-1.0.1/" target="_blank">REST 1.0.1</a> (03 Nov 2019)<br>
                            <a href="/releases/ITS-REST/Release-1.0.0/" target="_blank">REST 1.0.0</a> (07 Dec 2018)<br>
                            <a href="https://github.com/openEHR/specifications-ITS-XML/releases/tag/Release-1.0.2" target="_blank">XML 1.0.2</a> (31 Dec 2008)
                        </p>

                    </div>
                </div>
            </div>
        </div>

		<div class="specs_category_box">
			<!-- =============== Formal Specs: Analytics =============== -->
			<div id="analytics">
                <p class="group_title">Analytics</p>
				<div class="group_box">
					<!-------------- CDS --------------->
					<div id="cds_row" class="component_row">
                        <div class="component_cell">
                            <p id="CDS" class="component_name">
                                <a href="/releases/CDS/latest/index" target="_blank">CDS</a>
                            </p>
                            <p>(Clinical Decision<br>Support)</p>
                            <p>
                                <a href="/components/CDS/open_issues" target="_blank">PRs</a> | <a href="https://openehr.atlassian.net/projects/SPECCDS?orderField=RANK&selectedItem=com.atlassian.jira.jira-projects-plugin%3Arelease-page&status=released-unreleased" target="_blank">CRs</a>
                            </p>
                            <p><a href="/releases/CDS/latest/UML/openEHR_UML-CDS.mdzip">UML</a></p>
                        </div>

                        <div class="specs_cell" style="background-color:#AEDFB3;">
                            <p class="specs_item_wide">
                                <a href="/releases/CDS/latest/GDL2.html" target="_blank">GDL2</a><br>Guideline Definition Language v2
                            </p>
                            <p class="specs_item_wide">
                                <a href="/releases/CDS/latest/GDL.html" target="_blank">GDL</a><br>Guideline Definition Language v1
                            </p>
                        </div>

                        <p class="releases">
						</p>
					</div>
                    
				</div>
			</div>

			<!-- =============== Formal Specs: Service Models =============== -->
			<div id="services">
                <p class="group_title">Platform Service Interface</p>
				<div class="group_box">
					<!-------------- SM --------------->
					<div id="sm_row" class="component_row">
                        <div class="component_cell">
                            <p id="SM" class="component_name">
                                <a href="/releases/SM/latest/index" target="_blank">SM</a>
                            </p>
                            <p>(Service Model)</p>
                            <p>
                                <a href="/components/SM/open_issues" target="_blank">PRs</a> | <a href="https://openehr.atlassian.net/projects/SPECSM?orderField=RANK&selectedItem=com.atlassian.jira.jira-projects-plugin%3Arelease-page&status=released-unreleased" target="_blank">CRs</a>
                            </p>
                            <p><a href="/releases/SM/latest/UML/openEHR_UML-SM.mdzip">UML</a></p>
                        </div>

                        <div class="specs_cell" style="background-color:#FAE665;">
                            <p class="specs_item_wide">
                                <a href="/releases/SM/latest/openehr_platform.html" target="_blank">Platform Services</a><br>Ehr, Query, Definitions, EhrIndex, Admin, Demographic, Terminology, Message, SystemLog<br>
                            </p>
                            <p class="specs_item_wide">
                                <a href="/releases/SM/latest/simplified_im_b.html" target="_blank">SIM-B</a><br>Simplified Information Model 'B' for use with Simplified Data Template
                            </p>
                        </div>

                        <p class="releases">
						</p>
					</div>
				</div>
			</div>
			
			<!-- =============== Formal Specs: Content & Process =============== -->
			<div id="content_process">
                <p class="group_title">Content and Process</p>
				<div class="group_box">
					<!-------------- PROC --------------->
					<div id="proc_row" class="component_row">
                        <div class="component_cell">
                            <p id="PROC" class="component_name">
                                <a href="/releases/PROC/latest/index" target="_blank">PROC</a>
                            </p>
                            <p>(Process Model)</p>
                            <p>
                                <a href="/components/PROC/open_issues" target="_blank">PRs</a> | <a href="https://openehr.atlassian.net/projects/SPECPROC?orderField=RANK&selectedItem=com.atlassian.jira.jira-projects-plugin%3Arelease-page&status=released-unreleased" target="_blank">CRs</a>
                            </p>
                            <p><a href="/releases/PROC/latest/UML/openEHR_UML-PROC.mdzip">UML</a></p>
                        </div>

                        <div class="specs_cell" style="background-color:#ACDCE8;">
                            <p class="specs_item">
                                <a href="/releases/PROC/latest/task_planning.html" target="_blank">Task Planning (TP)</a><br>An adaptive, executable, team-based model of workflow - Work Plan, Task Plan, Event
                            </p>
                            <p class="specs_item">
                                <a href="/releases/PROC/latest/tp_vml.html" target="_blank">TP Visual Modelling<br>Language (TP-VML)</a><br>A visual modelling language for clinical plans and workflows.
                            </p>
                            <p class="specs_item">
                                <a href="/releases/PROC/latest/tp_examples.html" target="_blank">TP Examples</a><br>Real-world worked TP examples.
                            </p>
                        </div>

                        <p class="releases">
							<a href="/releases/PROC/Release-1.0.0/" target="_blank">1.0.0</a> (1 Dec 2017)
						</p>
					</div>

					<!-------------- RM --------------->
					<div id="rm_row" class="component_row">
                        <div class="component_cell">
                            <p id="RM" class="component_name">
                                <a href="/releases/RM/latest/index" target="_blank">RM</a>
                            </p>
                            <p>(Reference Model)</p>
                            <p>
                                <a href="/components/RM/open_issues" target="_blank">PRs</a> | <a href="https://openehr.atlassian.net/projects/SPECRM?orderField=RANK&selectedItem=com.atlassian.jira.jira-projects-plugin%3Arelease-page&status=released-unreleased" target="_blank">CRs</a>
                            </p>
                            <p><a href="/releases/RM/latest/UML/openEHR_UML-RM.mdzip">UML</a></p>
                        </div>
                        
                        <div class="specs_cell" style="background-color:#ACDCE8;">                        
                            <p class="specs_item">
                                <a href="/releases/RM/latest/demographic.html" target="_blank">Demographic</a><br>Party, PartyRelationship, Actor, Role, Contact, Address
                            </p>
                            <p class="specs_item">
                                <a href="/releases/RM/latest/ehr.html" target="_blank">EHR</a><br>Composition, Section, Entry, Observation, Evaluation, Instruction, Action, AdminEntry
                            </p>
                            <p class="specs_item">
                                <a href="/releases/RM/latest/ehr_extract.html" target="_blank">EHR Extract</a><br>OpenEhrExtract, GenericExtract, ExtractRequest, ExtractSpec
                            </p>
                            <p class="specs_item">
                                <a href="/releases/RM/latest/common.html" target="_blank">Common</a><br>VersionedObject, Version, PartySelf, AuditDetails
                            </p>
                            <p class="specs_item">
                                <a href="/releases/RM/latest/integration.html" target="_blank">Integration</a><br>IntegrationEntry
                            </p>
                            <p class="specs_item">
                                <a href="/releases/RM/latest/data_structures.html" target="_blank">Data Structures</a><br>History, Event, ItemTree, Cluster, Element
                            </p>
                            <p class="specs_item">
                                <a href="/releases/RM/latest/data_types.html" target="_blank">Data Types</a><br>DvBoolean, DvText, DvCodedText, DvUri, DvQuantity, DvDate/Time types, DvMultimedia
                            </p>
                            <p class="specs_item">
                                <a href="/releases/RM/latest/support.html" target="_blank">Support</a><br>Terminology and Measurement service interfaces
                            </p>
                        </div>
                        
						<p class="releases">
							<a href="https://openehr.atlassian.net/projects/SPECRM/versions/12516/tab/release-report-all-issues" target="_blank">1.1.0</a> (cooking)<br>
							<a href="/releases/RM/Release-1.0.4/" target="_blank">1.0.4</a> (04 Jan 2019)<br>
							<a href="/releases/RM/Release-1.0.3/" target="_blank">1.0.3</a> (15 Dec 2015)<br>
							<a href="/releases/RM/Release-1.0.2/" target="_blank">1.0.2</a> (20 Dec 2008)
						</p>
					</div>

					<!-------------- TERM --------------->
					<div id="term_row" class="component_row">
                        <div class="component_cell">
                            <p id="TERM" class="component_name">
                                <a href="/releases/TERM/latest/index" target="_blank">TERM</a>
                            </p>
                            <p>(Terminology)</p>
                            <p>
                                <a href="/components/TERM/open_issues" target="_blank">PRs</a> | <a href="https://openehr.atlassian.net/projects/SPECTERM?orderField=RANK&selectedItem=com.atlassian.jira.jira-projects-plugin%3Arelease-page&status=released-unreleased" target="_blank">CRs</a>
                            </p>
                        </div>
                        
                        <div class="specs_cell" style="background-color:#ACDCE8;">                        
                            <p class="specs_item_wide">
                                <a href="/releases/TERM/latest/SupportTerminology.html" target="_blank">openEHR Terminology</a>:
                                <a href="https://github.com/openEHR/terminology/blob/master/openEHR_RM/openehr_external_terminologies.xml#L2" target="_blank">Countries (ISO 3166)</a> |
                                <a href="https://github.com/openEHR/terminology/blob/master/openEHR_RM/openehr_external_terminologies.xml#L263" target="_blank">Languages (ISO 639-1)</a> |
                                <a href="https://github.com/openEHR/terminology/blob/master/openEHR_RM/openehr_external_terminologies.xml#L250" target="_blank">Character sets (IANA)</a> |
                                <a href="https://github.com/openEHR/terminology/blob/master/openEHR_RM/openehr_external_terminologies.xml#L399" target="_blank">Media types (IANA)</a><br>

                                <a href="https://github.com/openEHR/terminology/blob/master/openEHR_RM/en/openehr_terminology.xml#L22" target="_blank">Attestation reason</a> |
                                <a href="https://github.com/openEHR/terminology/blob/master/openEHR_RM/en/openehr_terminology.xml#L26" target="_blank">Audit change type</a> |
                                <a href="https://github.com/openEHR/terminology/blob/master/openEHR_RM/en/openehr_terminology.xml#L35" target="_blank">Composition category</a> |
                                <a href="https://github.com/openEHR/terminology/blob/master/openEHR_RM/en/openehr_terminology.xml#L2" target="_blank">Compression algorithms</a> |
                                <a href="https://github.com/openEHR/terminology/blob/master/openEHR_RM/en/openehr_terminology.xml#L294" target="_blank">Event math function</a> |
                                <a href="https://github.com/openEHR/terminology/blob/master/openEHR_RM/en/openehr_terminology.xml#L218" target="_blank">Instruction states</a> |
                                <a href="https://github.com/openEHR/terminology/blob/master/openEHR_RM/en/openehr_terminology.xml#L230" target="_blank">Instruction transitions</a> |
                                <a href="https://github.com/openEHR/terminology/blob/master/openEHR_RM/en/openehr_terminology.xml#L9" target="_blank">Integrity check algorithms</a> |
                                <a href="https://github.com/openEHR/terminology/blob/master/openEHR_RM/en/openehr_terminology.xml#L40" target="_blank">MultiMedia</a> |
                                <a href="https://github.com/openEHR/terminology/blob/master/openEHR_RM/en/openehr_terminology.xml#L13" target="_blank">Normal statuses</a> |
                                <a href="https://github.com/openEHR/terminology/blob/master/openEHR_RM/en/openehr_terminology.xml#L178" target="_blank">Null flavours</a> |
                                <a href="https://github.com/openEHR/terminology/blob/master/openEHR_RM/en/openehr_terminology.xml#L253" target="_blank">Participation function</a> |
                                <a href="https://github.com/openEHR/terminology/blob/master/openEHR_RM/en/openehr_terminology.xml#L184" target="_blank">Participation mode</a> |
                                <a href="https://github.com/openEHR/terminology/blob/master/openEHR_RM/en/openehr_terminology.xml#L92" target="_blank">Property</a> |
                                <a href="https://github.com/openEHR/terminology/blob/master/openEHR_RM/en/openehr_terminology.xml#L307" target="_blank">Setting</a> |
                                <a href="https://github.com/openEHR/terminology/blob/master/openEHR_RM/en/openehr_terminology.xml#L251" target="_blank">Subject relationship</a> |
                                <a href="https://github.com/openEHR/terminology/blob/master/openEHR_RM/en/openehr_terminology.xml#L289" target="_blank">Term mapping purpose</a> |
                                <a href="https://github.com/openEHR/terminology/blob/master/openEHR_RM/en/openehr_terminology.xml#L170" target="_blank">Version lifecycle state</a>
                            </p>
                        </div>
                    
						<p class="releases">
							<a href="/releases/TERM/Release-2.1.0/" target="_blank">2.1.0</a> (08 Nov 2017)
						</p>
					</div>
				</div>
			</div>
			
			<!-- =============== Formal Specs: Formalisms =============== -->
			<div id="formalisms_group">
                <p class="group_title">Formalisms</p>
				<div class="group_box">
					<!-------------- QUERY --------------->
					<div id="query" class="component_row">
                        <div class="component_cell">
                            <p id="QUERY" class="component_name">
                                <a href="/releases/QUERY/latest/index" target="_blank">QUERY</a>
                            </p>
                            <p>(Query language)</p>
                            <p>
                                <a href="/components/QUERY/open_issues" target="_blank">PRs</a> | <a href="https://openehr.atlassian.net/projects/SPECQUERY?orderField=RANK&selectedItem=com.atlassian.jira.jira-projects-plugin%3Arelease-page&status=released-unreleased" target="_blank">CRs</a>
                            </p>
                        </div>

                        <div class="specs_cell" style="background-color:#E3E4E5;">                                                
                            <p class="specs_item_wide">
                                <a href="/releases/QUERY/latest/AQL.html" target="_blank">AQL</a><br>Archetype Querying Language
                            </p>
                        </div>
                        
						<p class="releases">
							<a href="/releases/QUERY/Release-1.0.0/" target="_blank">1.0.0</a> (15 Nov 2017)
						</p>
					</div>

					<!-------------- AM --------------->
					<div id="am" class="component_row">
                        <div class="component_cell">
                            <p id="AM" class="component_name">
                                <a href="/releases/AM/latest/index" target="_blank">AM</a>
                            </p>
                            <p>(Archetype Model)</p>
                            <p>
                                <a href="/components/AM/open_issues" target="_blank">PRs</a> | <a href="https://openehr.atlassian.net/projects/SPECAM?orderField=RANK&selectedItem=com.atlassian.jira.jira-projects-plugin%3Arelease-page&status=released-unreleased" target="_blank">CRs</a>
                            </p>
                            <p>
                                <a href="/releases/AM/latest/UML/openEHR_UML-AM.mdzip">AOM2 UML</a><br>
                                <a href="/releases/AM/latest/UML/openEHR_UML-AM-14.mdzip">AOM1.4 UML</a>

                            </p>
                        </div>

                        <div class="specs_cell" style="background-color:#E3E4E5;">                                                
                            <p class="specs_item_narrow">
                                <a href="/releases/AM/latest/ADL2.html" target="_blank">ADL 2</a><br>Archetype Definition Language 2
                            </p>
                            <p class="specs_item">
                                <a href="/releases/AM/latest/AOM2.html" target="_blank">AOM 2</a><br>Archetype, AuthoredArchetype, Template, OperationalTemplate, CObject, ArchetypeSlot, CAttribute, CPrimitive
                            </p>
                            <p class="specs_item_narrow">
                                <a href="/releases/AM/latest/OPT2.html" target="_blank">OPT 2</a><br>Operational Template 2
                            </p>
                            <p class="specs_item_narrow">
                                <a href="/releases/AM/latest/ADL1.4.html" target="_blank">ADL 1.4</a><br>Archetype Definition Language 1.4
                            </p>
                            <p class="specs_item">
                                <a href="/releases/AM/latest/AOM1.4.html" target="_blank">AOM 1.4</a><br>Archetype, CObject, ArchetypeSlot, CAttribute, CPrimitive
                            </p>
                            <p class="specs_item_narrow">
                                <a href="" target="_blank">OPT 1.4</a><br>Operational Template 1.4
                            </p>
                            <p class="specs_item">
                                <a href="/releases/AM/latest/Identification.html" target="_blank">Identification</a><br>archetype / template identifiers; versioning rules
                            </p>
                        </div>
                        
						<p class="releases">
							<a href="/releases/AM/Release-2.0.6/" target="_blank">2.0.6</a> (07 Jan 2017)<br>
							<a href="/releases/AM/Release-2.0.6/" target="_blank">1.4</a> (31 Dec 2008)
						</p>
					</div>

					<!-------------- LANG --------------->
					<div id="lang" class="component_row">
                        <div class="component_cell">
                            <p id="LANG" class="component_name">
                                <a href="/releases/LANG/latest/index" target="_blank">LANG</a>
                            </p>
                            <p>(Generic Languages)</p>
                            <p>
                                <a href="/components/LANG/open_issues" target="_blank">PRs</a> | <a href="https://openehr.atlassian.net/projects/SPECLANG?orderField=RANK&selectedItem=com.atlassian.jira.jira-projects-plugin%3Arelease-page&status=released-unreleased" target="_blank">CRs</a>
                            </p>
                            <p><a href="/releases/LANG/latest/UML/openEHR_UML-LANG.mdzip">UML</a></p>
                        </div>
                        
                        <div class="specs_cell" style="background-color:#E3E4E5;">                                                
                            <p class="specs_item">
                                <a href="/releases/LANG/latest/expression_language.html" target="_blank">Expression Language</a><br>a syntax for formal expressions
                            </p>
                            <p class="specs_item">
                                <a href="/releases/LANG/latest/bmm.html" target="_blank">BMM</a><br>Basic Meta-Model - BmmSchema, BmmModel, BmmClass, BmmType, BmmProperty
                            </p>
                            <p class="specs_item">
                                <a href="/releases/LANG/latest/bmm_persistence.html" target="_blank">P_BMM</a><br>BMM Human-readable serial format - PBmmSchema, P_xxx types
                            </p>
                            <p class="specs_item">
                                <a href="/releases/LANG/latest/odin.html" target="_blank">ODIN</a><br>Object Data Instance Notation
                            </p>
                        </div>
                        
						<p class="releases">
							<a href="https://openehr.atlassian.net/projects/SPECLANG/versions/12518/tab/release-report-all-issues" target="_blank">1.0.0</a> (cooking)
						</p>
					</div>
				</div>
			</div>
			
			<!-- =============== Formal Specs: Foundations =============== -->
			<div id="foundations">
                <p class="group_title">Foundations</p>
				<div class="group_box">
					<!-------------- BASE --------------->
					<div id="base_row" class="component_row">
                        <div class="component_cell">
                            <p id="BASE" class="component_name">
                                <a href="/releases/BASE/latest/index" target="_blank">BASE</a>
                            </p>
                            <p>(Base models)</p>
                            <p>
							     <a href="/components/BASE/open_issues" target="_blank">PRs</a> | <a href="https://openehr.atlassian.net/projects/SPECBASE?   orderField=RANK&selectedItem=com.atlassian.jira.jira-projects-plugin%3Arelease-page&status=released-unreleased" target="_blank">CRs</a>
                            </p>
                            <p><a href="/releases/BASE/latest/UML/openEHR_UML-Base.mdzip">UML</a></p>
                        </div>
                        
                        <div class="specs_cell" style="background-color:#F3F4F5;">                                                
                            <p class="specs_item">
                                <a href="/releases/BASE/latest/base_types.html" target="_blank">Base Types</a><br>Definitions, Identifiers
                            </p>
                            <p class="specs_item">
                                <a href="/releases/BASE/latest/resource.html" target="_blank">Resource</a><br>AuthoredResource
                            </p>
                            <p class="specs_item">
                                <a href="/releases/BASE/latest/foundation_types.html" target="_blank">Foundation Types</a><br>Values, Structures, Interval, Date/times
                            </p>
                        </div>
                        
						<p class="releases">
							<a href="/releases/BASE/Release-1.1.0/" target="_blank">1.1.0</a> (22 Jan 2019)<br>
							<a href="/releases/BASE/Release-1.0.3/" target="_blank">1.0.3</a> (15 Dec 2015)
						</p>
					</div>
				</div>
			</div>
		</div>


<!-- ------------------------------------------- Content ends here ------------------------------------------------- -->
		</div>	
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/templates/_footer.php');?>
