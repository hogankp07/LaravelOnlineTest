@extends('layouts.page')
@section('content')
<div class="homecontainer container">
<div class="container">

	{!! Form::open([
                                                    "name"              => "create_sections",
                                                    "id"                => "create_sections",
                                                    "url"            => "/admin/add_section",
                                                    "method"            => "POST",
                                                    'files' => true

                                                            ])
                                            !!}


	<div class="col-xs-12">
		<div class="col-md-12">
			<div class="row">

				<div class="col-md-8">
					<div class="panel-group panel-group1" >
						<div class="panel panel-default">
							<div class="panel-heading panelcolor1">
								<h4 class="panel-title">
									<i class="fa fa-code-fork"></i> Section Details
								</h4>
							</div>
							<div  class="panel-collapse collapse in">
								<div class="panel-body">

									<div class="">

										<div class="form-group row">
											<div class="col-md-12">
												<div class="col-md-12">

													<div class="form-group">
														<label for="title">Section Instructions:</label>
														<input type="hidden" name="qp_id" value="{!! $details->qp_id !!}">
														<textarea class="form-control editable"  name="terms_conditions" placeholder="Instructions" id="Instructions" rows="5" ></textarea>
													</div>
													<span class="help-block"> <b>NOTE : </b> Each section can cantain only one comprehention question (or) Questions based on given paragraph </span>
												</div>
											</div>
										</div>

										<div class="form-group row">
											<div class="col-md-12">
												<div class="form-group">
													<div class="col-xs-4">
														<label for="title">Section type: </label>
													</div>
													<div class="col-xs-8">
														<input type="radio" name="section_type" class="section_type" value="1" /> Options / Fill blanks<br>
														<input type="radio" name="section_type" class="section_type" value="2"/> Comprehension / Based on paragraph
													</div>
												</div>

											</div>
										</div>

										<div class="row comp_container" hidden>
											<div class="col-xs-12">
											<div class="row">
												<div class="col-xs-12">
													<div class="col-xs-4">
														<label for="qns">Comprehension Type : </label>

													</div>
													<div class="col-xs-8">
														<input type="checkbox" name="question_type" class="question_type" value="1" checked="checked"/> Text
														<input type="checkbox" name="question_type" class="question_type" value="2"/> Image
													</div>
												</div>
											</div>
											<div class="question_text">
												<div class="col-xs-12">
													<textarea class="form-control editable" placeholder="Section Paragraph " name="section_question" data-bv-excluded="false"></textarea>
												</div>
											</div>
											<div class="question_image" hidden>
												<div class="col-xs-12">

													<span class="file-input btn btn2 btn-block btn-primary btn-file">
                											Click here to upload section image <input type="file" name="question_image" multiple data-bv-excluded="false">
            										</span>
													<br><label class="question_image_view" hidden>Section Image :</label>
													<center>
														<div class="question_image_view" hidden>
															<img src="" name="section_image" class="question_image_file" width="300px" height="200px">
														</div>
														<span class="question_image_view" hidden>
															<a href="#" class="href1 remove_question_image_file"><span class="glyphicon glyphicon-minus-sign"></span> Remove Image</a>
														</span>
													</center>
												</div>

											</div>
										</div>
										</div>

										<br>

										<div class="form-group row">
											<div class="col-md-12">
												<div class="form-group">
													<div class="col-xs-4">
														<label for="title">Subject : </label>
													</div>
													<div class="col-xs-8">
														<select class="form-control multiselect section_subject" name="section_subject">
															<option value="" selected disabled>Select the option</option>
															@foreach($subject as $key => $value)
																<option value="{{ $key }}">{{ $value }}</option>
															@endforeach
														</select>
													</div>
												</div>

											</div>
										</div>

										<div class="form-group row">
											<div class="col-md-12">
												<div class="form-group">
													<div class="col-xs-4">
														<label for="title">Chapter : </label>
													</div>
													<div class="col-xs-8">
														<select class="form-control multiselect subject_chapter" name="section_chapter">
															<option value="" selected disabled>Select Subject</option>
														</select>
													</div>
												</div>

											</div>
										</div>

										<div class="form-group row">
											<div class="col-md-12">
												<?php $remaining= $details->number_of_questions ?>
												@foreach($section as $key => $value)
													<?php  $remaining = $remaining - $value -> number_of_questions_section  ?>
												@endforeach
												<div class="form-group">
													<div class="col-sm-4 col-xs-6">
														<label for="title">No.of.Questions in section : </label>
													</div>
													<div class="col-sm-5 col-xs-3">
														<input type="number" min="1" max="{!! $remaining !!}" name="number_of_questions_section" class="form-control number_of_questions_section" id="number_of_questions_section" placeholder="0">
													</div>
													<div class="col-xs-3">
														 <span class="font12px"> Remaining Questions {{ $remaining}}</span>
														<input type="hidden" value="{{$remaining}}" name="question_remaining" class="question_remaining" disabled="disabled">
													</div>
												</div>

											</div>
										</div>

										<div class="form-group row">
											<div class="col-md-12">
												<div class="form-group">
													<div class="col-sm-4 col-xs-6">
														<label for="title">Marks Per Question : </label>
													</div>
													<div class="col-sm-5 col-xs-3">
														<input type="number" min="0" name="marks_per_question" class="form-control marks_per_question" id="marks_per_question" placeholder="0">
													</div>
												</div>

											</div>
										</div>

										<div class="form-group row">
											<div class="col-md-12">
												<div class="form-group">
													<div class="col-sm-4 col-xs-6">
														<label>Section Marks : </label>
													</div>
													<div class="col-sm-5 col-xs-3">
														<?php $remaining_marks= $details->total_marks ?>
														@foreach($section as $key => $value)
															<?php  $remaining_marks = $remaining_marks - $value -> section_total  ?>
														@endforeach
															<input type="hidden" value="{{$remaining_marks}}" name="max_remaining" class="max_remaining" disabled="disabled">
														<input type="number" min="1"  name="section_total" class="form-control section_total" id="section_total" readonly>
													</div>
													<div class="col-xs-3">
														<span class="font12px"> Remaining marks : {{ $remaining_marks}}</span>
													</div>
												</div>

											</div>
										</div>




										<center>
											@if($remaining)
											@if($section)
											<button class="btn btn2 remove_section_image" type="submit" name="action" value="1">Save & Proceed</button>
											@endif
											<button class="btn btn1 remove_section_image" type="submit" name="action" value="2">Add New Section</button>
											@endif
											@if($section)
											<button class="btn"  data-toggle="modal" data-target="#model_cancel" onclick="return false;">Cancel</button>
											@else
												<a href="/index.php/{!!$details->qp_id !!}/admin/edit_questionpaper" class="btn btn2" >Cancel</a>
											@endif
										</center>

									</div>

								</div>
						</div>
					</div>
				</div>

			</div>
				<div class="col-md-4">
					<div class="panel-group panel-group1" >
						<div class="panel panel-default">
							<div class="panel-heading panelcolor1">
								<h4 class="panel-title">
									 Question Paper Details
								</h4>
							</div>
							<div  class="panel-collapse collapse in">
								<div class="panel-body">
									<div class="row">
										<div class="col-xs-12">
											<a href="/index.php/{!!$details->qp_id !!}/admin/edit_questionpaper" class="href1"><i class="fa fa-pencil-square-o"></i> Edit Question Paper</a>
										</div>
									</div>
									<div class="well">

										<div class="row">
											<div class="col-xs-6">
												<label class="pull-right">Id : </label>
											</div>
											<div class="col-xs-6">
												{!! $details->qp_id !!}
											</div>
										</div>
										<div class="row">
											<div class="col-xs-6">
												<label class="pull-right">Title : </label>
											</div>
											<div class="col-xs-6">
												{!! $details->title !!}
											</div>
										</div>
										<div class="row">
											<div class="col-xs-6">
												<label class="pull-right">No.of.Qns : </label>
											</div>
											<div class="col-xs-6">
												{!! $details->number_of_questions !!}
											</div>
										</div>
										<div class="row">
											<div class="col-xs-6">
												<label class="pull-right">Total marks : </label>
											</div>
											<div class="col-xs-6">
												{!! $details->total_marks !!}
											</div>
										</div>
										<div class="row">
											<div class="col-xs-6">
												<label class="pull-right">Duration (mins) : </label>
											</div>
											<div class="col-xs-6">
												{!! $details->duration !!}
											</div>
										</div>

									</div>
									<div class="row">
										<div class="col-xs-12 ">
											<!--http://stackoverflow.com/questions/18325779/bootstrap-3-collapse-show-state-with-chevron-icon-->
											<div class="panel-group" id="accordion">
												@foreach($section as $key => $value)
													<div class="panel panel-default">
														<div class="panel-heading panelcolor2">
															<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#{!! "section".$key !!}">
																<h4 class="panel-title">Section {!! $value -> section_value !!} details</h4>
															</a>
														</div>
														<div id="{!! "section".$key !!}" class="panel-collapse collapse">
															<div class="panel-body">
																<div class="row">
																	<div class="col-xs-6">
																		<a href="/index.php/{!!$value->qp_id !!}/admin/edit_section/{!!$value->section_id !!}" class="href1"><i class="fa fa-pencil-square-o"></i> Edit </a>
																	</div>
																	<div class="col-xs-6">
																		<a data-toggle="modal" data-target="#section_delete"  class="href1 delete_section_href" id="{!!$value->section_id !!}"><i class="fa fa-trash-o"></i> Delete </a>
																	</div>
																</div>
																<hr>
																<div class="form-group row">
																	<label class="col-xs-6">Section Type :</label>
																<span class="col-xs-6">
																	@if ($value -> section_type == 1)
																		Options / Fill blanks
																	@else
																		Comprehension / Based on paragraph
																	@endif
																</span>
																</div>
																<div class="form-group row">
																	<label class="col-md-6">Subject :</label>
																	<span class="col-md-6">{!! $value -> section_subject !!}</span>
																</div>
																<div class="form-group row">
																	<label class="col-md-6">Chapter :</label>
																	<span class="col-md-6">{!! $value -> section_chapter !!}</span>
																</div>
																<div class="form-group row">
																	<label class="col-md-6">No.of.Questions :</label>
																	<span class="col-md-6">{!! $value -> number_of_questions_section !!}</span>
																</div>
																<div class="form-group row">
																	<label class="col-md-6">Marks/Question :</label>
																	<span class="col-md-6">{!! $value -> marks_per_question !!}</span>
																</div>
																<div class="form-group row">
																	<label class="col-md-6">Total Marks:</label>
																	<span class="col-md-6">{!! $value -> section_total !!}</span>
																</div>
															</div>
														</div>
													</div>
												@endforeach
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
		</div>
	</div>

</div>



</div>
</div>

</form>


</div>
</div>

	<!-- Modal -->
	<div class="modal fade" id="model_cancel" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">

				<div class="modal-body">
					<center>
					<h4>Are you sure to cancel and proceed to question paper?</h4>
					<a type="button" class="btn btn1 href1" href="/index.php/{!!  $details->qp_id !!}/admin/set_questions/1/1">Yes</a>
					<button type="button" class="btn btn2" data-dismiss="modal">No</button>
					</center>
				</div>

			</div>

		</div>
	</div>

<div class="modal fade" id="section_delete" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">

			<div class="modal-body">
				<center>
					<h4>Are you sure to delete the section?</h4>
					<form action="/index.php/admin/delete_section" method="post">
						<input type="hidden" name="qp_id" value="{!! $details->qp_id !!}">
						<input type="hidden" name="section_id" id="section_id" class="section_id">
						<button type="submit" class="btn btn1" >Yes</button>
						<button type="button" class="btn btn2" data-dismiss="modal" onclick="return false;">No</button>
					</form>
				</center>
			</div>

		</div>

	</div>
</div>


@stop