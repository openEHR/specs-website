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
				<img src="/openehr_block_diagram3.svg" alt="openEHR Components" width="60%">
			</div>

			<!-- --------------------------------------- Global index ----------------------------------------------- -->
			<table class="TableInvisible">
				<tbody>
					<tr>
						<td valign="top">
							<a href="/releases/BASE/latest/architecture_overview.html" target="_blank">Architecture Overview</a> |
							<a href="/releases/AM/latest/Overview.html" target="_blank">Archetype Technology</a> |
							<a href="/releases/UML/latest" target="_blank">GLOBAL UML</a> |
							<a href="/releases/AA_GLOBAL/latest/index.html" target="_blank">CLASS INDEX</a> |
							<a href="https://openehr.atlassian.net/wiki/spaces/spec/pages/357957633/Services+Landscape+for+e-Health" target="_blank">Services Landscape</a>
						</td>

					</tr>
				</tbody>
			</table>

		<div class="specs_group_box">
			<!-- =============== Implementation Specs =============== -->
			<div id="its_cnf">
                <p class="spec_group">Conformance and Implementation Technologies</p>
				<div>
					<!-------------- CNF --------------->
					<div id="cnf" class="component_box flex_box table_cell">
                        <div>
                            <p class="component">
                                <a id="CNF"></a>
                                <a href="/releases/CNF/latest/index" target="_blank">CNF</a>
                            </p>
                            <p>(Conformance)</p>
                            <a href="/components/CNF/open_issues" target="_blank">PRs</a>|<a href="https://openehr.atlassian.net/projects/SPECCNF?orderField=RANK&selectedItem=com.atlassian.jira.jira-projects-plugin%3Arelease-page&status=released-unreleased" target="_blank">CRs</a>
                        </div>
                        
                        <div class="specs_flex_box">                        
                            <p class="specs_item">
                                <a href="/releases/CNF/latest/openehr_platform_conformance.html" target="_blank">Platform Conformance</a>: System Under Test (SUT), Conformance Schedule, Profiles, Certification
                            </p>
                        </div>
                        
						<p class="releases">
						</p>
						
					</div>

					<!-------------- ITS --------------->
					<div id="its" class="component_box flex_box table_cell">
                        <div class="component">
                            <p>
                                <a id="ITS"></a>
                                <a href="/releases/ITS/latest/index" target="_blank">ITS</a>
                            </p>
                            <p>(Implementation<br>Technologies)</p>
                            <a href="/components/ITS/open_issues" target="_blank">PRs</a>|<a href="https://openehr.atlassian.net/projects/SPECITS?orderField=RANK&selectedItem=com.atlassian.jira.jira-projects-plugin%3Arelease-page&status=released-unreleased" target="_blank">CRs</a>
                        </div>
            
                        <div class="specs_flex_box">
                            <p class="specs_item">
                                <a href="/releases/ITS-REST/latest/index.html" target="_blank">REST APIs</a>: 
                                <a href="/releases/ITS-REST/latest/ehr.html" target="_blank">EHR</a>, 
                                <a href="/releases/ITS-REST/latest/query.html" target="_blank">Query</a>,
                                <a href="/releases/ITS-REST/latest/definitions.html" target="_blank">Definitions</a>
                            </p>
                            <p class="specs_item">
                                <a href="/releases/ITS-REST/latest/simplified_data_template.html" target="_blank">SDT</a>: Simplified Data Template
                            </p>
                            <p class="specs_item">
                                <a href="https://github.com/openEHR/specifications-ITS-XML" target="_blank">XSDs</a>: XML Schemas for the openEHR RM and AM
                            </p>
                            <p class="specs_item">
                                <a href="https://github.com/openEHR/specifications-ITS-JSON" target="_blank">JSON schema</a>: JSON Schemas for the openEHR RM and AM
                            </p>
                            <p class="specs_item">
                                <a href="https://github.com/openEHR/specifications-ITS-BMM" target="_blank">BMMs</a>: BMM schemas for Task Planning, RM, Expressions, BASE
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

		<div class="specs_group_box">
			<!-- =============== Formal Specs: Analytics =============== -->
			<div id="analytics">
                <p class="spec_group">Analytics</p>
				<div>
					<!-------------- CDS --------------->
					<div id="cds" class="component_box flex_box table_cell">
                        <div class="component">
                            <p>
                                <a id="CDS"></a>
                                <a href="/releases/CDS/latest/index" target="_blank">CDS</a>
                            </p>(Clinical Decision Support)<p>
                            <a href="/components/CDS/open_issues" target="_blank">PRs</a>|<a href="https://openehr.atlassian.net/projects/SPECCDS?orderField=RANK&selectedItem=com.atlassian.jira.jira-projects-plugin%3Arelease-page&status=released-unreleased" target="_blank">CRs</a>
                        </div>

                        <div class="specs_flex_box">
                            <p class="specs_item">
                                <a href="/releases/CDS/latest/GDL2.html" target="_blank">GDL2</a>: Guideline Definition Language v2
                            </p>
                            <p class="specs_item">
                                <a href="/releases/CDS/latest/GDL.html" target="_blank">GDL</a>: Guideline Definition Language v1
                            </p>
                        </div>

                        <p class="releases">
						</p>
					</div>
                    
				</div>
			</div>

			<!-- =============== Formal Specs: Service Models =============== -->
			<div id="services">
                <p class="spec_group">Platform Service Interface</p>
				<div>
					<!-------------- SM --------------->
					<div id="sm" class="component_box flex_box table_cell">
                        <div class="component">
                            <p>
                                <a id="SM"></a>
                                <a href="/releases/SM/latest/index" target="_blank">SM</a>
                            </p>
                            <p>(Service Model)</p> 
                            <a href="/components/SM/open_issues" target="_blank">PRs</a>|<a href="https://openehr.atlassian.net/projects/SPECSM?orderField=RANK&selectedItem=com.atlassian.jira.jira-projects-plugin%3Arelease-page&status=released-unreleased" target="_blank">CRs</a>
                        </div>

                        <div class="specs_flex_box">
                            <p class="specs_item">
                                <a href="/releases/SM/latest/openehr_platform.html" target="_blank">Platform Services</a>: Ehr, Query, Definitions, EhrIndex, Admin, Demographic, Terminology, Message, SystemLog<br>
                                <a href="/releases/SM/latest/simplified_im_b.html" target="_blank">SIM-B</a>: Simplified Information Model 'B' for use with Simplified Data Template
                            </p>
                        </div>

                        <p class="releases">
						</p>
					</div>
				</div>
			</div>
			
			<!-- =============== Formal Specs: Content & Process =============== -->
			<div id="content_process">
                <p class="spec_group">Content and Process</p>
				<div>
					<!-------------- PROC --------------->
					<div id="proc" class="component_box flex_box table_cell">
                        <div class="component">
                            <p>
                                <a id="PROC"></a>
                                <a href="/releases/PROC/latest/index" target="_blank">PROC</a>
                            </p>
                            <p>(Process Model)</p>
                            <a href="/components/PROC/open_issues" target="_blank">PRs</a>|<a href="https://openehr.atlassian.net/projects/SPECPROC?orderField=RANK&selectedItem=com.atlassian.jira.jira-projects-plugin%3Arelease-page&status=released-unreleased" target="_blank">CRs</a>
                        </div>

                        <div class="specs_flex_box">
                            <p class="specs_item">
                                <a href="/releases/PROC/latest/task_planning.html" target="_blank">Task Planning (TP)</a>: An adaptive, executable, team-based model of workflow - Work Plan, Task Plan, Event<br>
                                <a href="/releases/PROC/latest/tp_vml.html" target="_blank">TP Visual Modelling Language (TP-VML)</a>:<br>A visual modelling language for clinical plans and workflows.<br>
                                <a href="/releases/PROC/latest/tp_examples.html" target="_blank">TP Examples</a>:<br>Real-world worked TP examples.
                            </p>
                        </div>

                        <p class="releases">
							<a href="/releases/PROC/Release-1.0.0/" target="_blank">1.0.0</a> (1 Dec 2017)
						</p>
					</div>

					<!-------------- RM --------------->
					<div id="rm" class="component_box flex_box table_cell">
						<p class="component">
                            <a id="RM"></a>
                            <a href="/releases/RM/latest/index" target="_blank">RM<br>(Reference Model)</a><br>
						    <a href="/components/RM/open_issues" target="_blank">PRs</a>|<a href="https://openehr.atlassian.net/projects/SPECRM?orderField=RANK&selectedItem=com.atlassian.jira.jira-projects-plugin%3Arelease-page&status=released-unreleased" target="_blank">CRs</a>
                        </p>
						<p class="specs_item">
                            <a href="/releases/RM/latest/demographic.html" target="_blank">Demographic</a>: Party, Party_relationship, Actor, Role, Contact, Address<br>
                            <a href="/releases/RM/latest/ehr.html" target="_blank">EHR</a>: Composition, Section, Entry, Observation, Evaluation, Instruction, Action, Admin_entry<br>
                            <a href="/releases/RM/latest/ehr_extract.html" target="_blank">EHR Extract</a>: OpenehrExtract, GenericExtract<br>
                            <a href="/releases/RM/latest/common.html" target="_blank">Common</a>: Versioned_object, Version, Party_self, Audit_details<br>
                            <a href="/releases/RM/latest/integration.html" target="_blank">Integration</a>: IntegrationEntry<br>
							<a href="/releases/RM/latest/data_structures.html" target="_blank">Data Structures</a>: History, Event, ItemTree, Cluster, Element<br>
                            <a href="/releases/RM/latest/data_types.html" target="_blank">Data Types</a>: DvBoolean, DvText, DvCodedText, DvUri, DvQuantity, DvDate/Time types, DvMultimedia<br>
                            <a href="/releases/RM/latest/support.html" target="_blank">Support</a>: Terminology and Measurement service interfaces
						</p>
						<p class="releases">
							<a href="https://openehr.atlassian.net/projects/SPECRM/versions/12516/tab/release-report-all-issues" target="_blank">1.1.0</a> (cooking)<br>
							<a href="/releases/RM/Release-1.0.4/" target="_blank">1.0.4</a> (04 Jan 2019)<br>
							<a href="/releases/RM/Release-1.0.3/" target="_blank">1.0.3</a> (15 Dec 2015)<br>
							<a href="/releases/RM/Release-1.0.2/" target="_blank">1.0.2</a> (20 Dec 2008)
						</p>
					</div>

					<!-------------- TERM --------------->
					<div id="term" class="component_box flex_box table_cell">
						<p class="component">
                            <a id="TERM"></a><a href="/releases/TERM/latest/index" target="_blank">TERM<br>(Terminology)</a><br>
							<a href="/components/TERM/open_issues" target="_blank">PRs</a>|<a href="https://openehr.atlassian.net/projects/SPECTERM?orderField=RANK&selectedItem=com.atlassian.jira.jira-projects-plugin%3Arelease-page&status=released-unreleased" target="_blank">CRs</a>
                        </p>
						<p class="specs_item">
                            <a href="/releases/TERM/latest/SupportTerminology.html" target="_blank">openEHR Terminology</a>:
                            <a href="https://github.com/openEHR/terminology/blob/master/openEHR_RM/openehr_external_terminologies.xml#L2" target="_blank">Countries (ISO 3166)</a>|
                            <a href="https://github.com/openEHR/terminology/blob/master/openEHR_RM/openehr_external_terminologies.xml#L263" target="_blank">Languages (ISO 639-1)</a>|
                            <a href="https://github.com/openEHR/terminology/blob/master/openEHR_RM/openehr_external_terminologies.xml#L250" target="_blank">Character sets (IANA)</a>|
                            <a href="https://github.com/openEHR/terminology/blob/master/openEHR_RM/openehr_external_terminologies.xml#L399" target="_blank">Media types (IANA)</a><br>

                            <a href="https://github.com/openEHR/terminology/blob/master/openEHR_RM/en/openehr_terminology.xml#L22" target="_blank">Attestation reason</a>|
                            <a href="https://github.com/openEHR/terminology/blob/master/openEHR_RM/en/openehr_terminology.xml#L26" target="_blank">Audit change type</a>|
                            <a href="https://github.com/openEHR/terminology/blob/master/openEHR_RM/en/openehr_terminology.xml#L35" target="_blank">Composition category</a>|
                            <a href="https://github.com/openEHR/terminology/blob/master/openEHR_RM/en/openehr_terminology.xml#L2" target="_blank">Compression algorithms</a>|
                            <a href="https://github.com/openEHR/terminology/blob/master/openEHR_RM/en/openehr_terminology.xml#L294" target="_blank">Event math function</a>|
                            <a href="https://github.com/openEHR/terminology/blob/master/openEHR_RM/en/openehr_terminology.xml#L218" target="_blank">Instruction states</a>|
                            <a href="https://github.com/openEHR/terminology/blob/master/openEHR_RM/en/openehr_terminology.xml#L230" target="_blank">Instruction transitions</a>|
                            <a href="https://github.com/openEHR/terminology/blob/master/openEHR_RM/en/openehr_terminology.xml#L9" target="_blank">Integrity check algorithms</a>|
                            <a href="https://github.com/openEHR/terminology/blob/master/openEHR_RM/en/openehr_terminology.xml#L40" target="_blank">MultiMedia</a>|
                            <a href="https://github.com/openEHR/terminology/blob/master/openEHR_RM/en/openehr_terminology.xml#L13" target="_blank">Normal statuses</a>|
                            <a href="https://github.com/openEHR/terminology/blob/master/openEHR_RM/en/openehr_terminology.xml#L178" target="_blank">Null flavours</a>|
                            <a href="https://github.com/openEHR/terminology/blob/master/openEHR_RM/en/openehr_terminology.xml#L253" target="_blank">Participation function</a>|
                            <a href="https://github.com/openEHR/terminology/blob/master/openEHR_RM/en/openehr_terminology.xml#L184" target="_blank">Participation mode</a>|
                            <a href="https://github.com/openEHR/terminology/blob/master/openEHR_RM/en/openehr_terminology.xml#L92" target="_blank">Property</a>|
                            <a href="https://github.com/openEHR/terminology/blob/master/openEHR_RM/en/openehr_terminology.xml#L307" target="_blank">Setting</a>|
                            <a href="https://github.com/openEHR/terminology/blob/master/openEHR_RM/en/openehr_terminology.xml#L251" target="_blank">Subject relationship</a>|
                            <a href="https://github.com/openEHR/terminology/blob/master/openEHR_RM/en/openehr_terminology.xml#L289" target="_blank">Term mapping purpose</a>|
                            <a href="https://github.com/openEHR/terminology/blob/master/openEHR_RM/en/openehr_terminology.xml#L170" target="_blank">Version lifecycle state</a>
						</p>
						<p class="releases">
							<a href="/releases/TERM/Release-2.1.0/" target="_blank">2.1.0</a> (08 Nov 2017)
						</p>
					</div>
				</div>
			</div>
			
			<!-- =============== Formal Specs: Formalisms =============== -->
			<div id="formalisms">
                <p class="spec_group">Formalisms</p>
				<div>
					<!-------------- QUERY --------------->
					<div id="query" class="component_box flex_box table_cell">
						<p class="component">
                            <a id="QUERY"></a><a href="/releases/QUERY/latest/index" target="_blank">QUERY<br>(Query language)</a><br>
						    <a href="/components/QUERY/open_issues" target="_blank">PRs</a>|<a href="https://openehr.atlassian.net/projects/SPECQUERY?orderField=RANK&selectedItem=com.atlassian.jira.jira-projects-plugin%3Arelease-page&status=released-unreleased" target="_blank">CRs</a>
                        </p>
						<p class="specs_item">
							<a href="/releases/QUERY/latest/AQL.html" target="_blank">AQL</a>: Archetype Querying Language
						</p>
						<p class="releases">
							<a href="/releases/QUERY/Release-1.0.0/" target="_blank">1.0.0</a> (15 Nov 2017)
						</p>
					</div>

					<!-------------- AM --------------->
					<div id="am" class="component_box flex_box table_cell">
						<p class="component">
                            <a id="AM"></a><a href="/releases/AM/latest/index" target="_blank">AM<br>(Archetype Model)</a><br>
						    <a href="/components/AM/open_issues" target="_blank">PRs</a>|<a href="https://openehr.atlassian.net/projects/SPECAM?orderField=RANK&selectedItem=com.atlassian.jira.jira-projects-plugin%3Arelease-page&status=released-unreleased" target="_blank">CRs</a>
                        </p>
						<p class="specs_item">
							<a href="" target="_blank">OPT 1.4</a>: Operational Template 1.4<br>
                            <a href="/releases/AM/latest/OPT2.html" target="_blank">OPT 2</a>: Operational Template 2<br>
                            <a href="/releases/AM/latest/ADL1.4.html" target="_blank">ADL 1.4</a>: Archetype Definition Language 1.4<br>
                            <a href="/releases/AM/latest/ADL2.html" target="_blank">ADL 2</a>: Archetype Definition Language 2<br>
                            <a href="/releases/AM/latest/AOM1.4.html" target="_blank">AOM 1.4</a>: Archetype, CObject, ArchetypeSlot, CAttribute, CPrimitive<br>
                            <a href="/releases/AM/latest/AOM2.html" target="_blank">AOM 2</a>: Archetype, AuthoredArchetype,Template, OperationalTemplate, CObject, ArchetypeSlot, CAttribute, CPrimitive<br>
                            <a href="/releases/AM/latest/Identification.html" target="_blank">Identification</a>: archetype / template identifiers; versioning rules
						</p>
						<p class="releases">
							<a href="/releases/AM/Release-2.0.6/" target="_blank">2.0.6</a> (07 Jan 2017)<br>
							<a href="/releases/AM/Release-2.0.6/" target="_blank">1.4</a> (31 Dec 2008)
						</p>
					</div>

					<!-------------- LANG --------------->
					<div id="lang" class="component_box flex_box table_cell">
						<p class="component">
                            <a id="LANG"></a><a href="/releases/LANG/latest/index" target="_blank">LANG<br>(Generic Languages)</a><br>
						    <a href="/components/LANG/open_issues" target="_blank">PRs</a>|<a href="https://openehr.atlassian.net/projects/SPECLANG?orderField=RANK&selectedItem=com.atlassian.jira.jira-projects-plugin%3Arelease-page&status=released-unreleased" target="_blank">CRs</a>
                        </p>
						<p class="specs_item">
                            <a href="/releases/LANG/latest/expression_language.html" target="_blank">Expression Language</a>: a syntax for formal expressions<br>
                            <a href="/releases/LANG/latest/bmm.html" target="_blank">BMM</a>: Basic Meta-Model - BmmSchema, BmmModel, BmmClass, BmmType, BmmProperty<br>
                            <a href="/releases/LANG/latest/bmm_persistence.html" target="_blank">P_BMM</a>: BMM Human-readable serial format - PBmmSchema, P_xxx types<br>
                            <a href="/releases/LANG/latest/odin.html" target="_blank">ODIN</a>: Object Data Instance Notation
						</p>
						<p class="releases">
							<a href="https://openehr.atlassian.net/projects/SPECLANG/versions/12518/tab/release-report-all-issues" target="_blank">1.0.0</a> (cooking)
						</p>
					</div>
				</div>
			</div>
			
			<!-- =============== Formal Specs: Foundations =============== -->
			<div id="foundations">
                <p class="spec_group">Foundations</p>
				<div>
					<!-------------- BASE --------------->
					<div id="base" class="component_box flex_box table_cell">
						<p class="component">
                            <a id="BASE"></a>
                            <a href="/releases/BASE/latest/index" target="_blank">BASE<br>(Base models)</a><br>
							<a href="/components/BASE/open_issues" target="_blank">PRs</a>|<a href="https://openehr.atlassian.net/projects/SPECBASE?orderField=RANK&selectedItem=com.atlassian.jira.jira-projects-plugin%3Arelease-page&status=released-unreleased" target="_blank">CRs</a>
                        </p>
						<p class="specs_item">
                            <a href="/releases/BASE/latest/base_types.html" target="_blank">Base Types</a>: Identifiers<br>
                            <a href="/releases/BASE/latest/resource.html" target="_blank">Resource</a>: AuthoredResource<br>
                            <a href="/releases/BASE/latest/foundation_types.html" target="_blank">Foundation Types</a>: Primitive types: Values, Structures, Interval, Date/times
						</p>
						<p class="releases">
							<a href="/releases/BASE/Release-1.1.0/" target="_blank">1.1.0</a> (22 Jan 2019)<br>
							<a href="/releases/BASE/Release-1.0.3/" target="_blank">1.0.3</a> (15 Dec 2015)
						</p>
					</div>
				</div>
			</div>
		</div>
			
			<!-- ------------------------------ UML quick access ------------------------------------------- -->
			<h2>UML Model Files</h2>
			<table class="TableBasic">
				<tbody>
					<tr>
						<th style="text-align:center"> Component </th>
						<th style="text-align:center"> UML source </th>
					</tr>

					<!-------------- SM --------------->
					<tr>
						<td> <a id="SM"></a><a href="/releases/SM/latest/index" target="_blank">SM</a></td>
						<td> <a href="/releases/SM/latest/UML/openEHR_UML-SM.mdzip">openEHR_UML-SM.mdzip</a></td>
					</tr>

					<!-------------- PROC --------------->
					<tr>
						<td> <a id="PROC"></a><a href="/releases/PROC/latest/index" target="_blank">PROC</a></td>
						<td> <a href="/releases/PROC/latest/UML/openEHR_UML-PROC.mdzip">openEHR_UML-PROC.mdzip</a></td>
					</tr>

					<!-------------- RM --------------->
					<tr>
						<td> <a id="RM"></a><a href="/releases/RM/latest/index" target="_blank">RM</a></td>
						<td> <a href="/releases/RM/latest/UML/openEHR_UML-RM.mdzip">openEHR_UML-RM.mdzip</a></td>
					</tr>

					<!-------------- AM --------------->
					<tr>
						<td> <a id="AM"></a><a href="/releases/AM/latest/index" target="_blank">AM</a></td>
						<td> 
							<a href="/releases/AM/latest/UML/openEHR_UML-AM.mdzip">openEHR_UML-AM.mdzip</a><br>
							<a href="/releases/AM/latest/UML/openEHR_UML-AM-14.mdzip">openEHR_UML-AM-14.mdzip</a>
						</td>
					</tr>

					<!-------------- LANG --------------->
					<tr>
						<td> <a id="LANG"></a><a href="/releases/LANG/latest/index" target="_blank">LANG</a></td>
						<td> <a href="/releases/LANG/latest/UML/openEHR_UML-LANG.mdzip">openEHR_UML-LANG.mdzip</a></td>
					</tr>

					<!-------------- BASE --------------->
					<tr>
						<td> <a id="BASE"></a><a href="/releases/BASE/latest/index" target="_blank">BASE</a></td>
						<td> <a href="/releases/BASE/latest/UML/openEHR_UML-Base.mdzip">openEHR_UML-BASE.mdzip</a></td>
					</tr>

				</tbody>
			</table>


<!-- ------------------------------------------- Content ends here ------------------------------------------------- -->
		</div>	
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/templates/_footer.php');?>
