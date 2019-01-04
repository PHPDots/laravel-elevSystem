@extends('frontend.layouts.app')

@section('content')
<div class="col-xs-12 col-sm-12 info">
    <p> Nedenfor kan du hvilke ydelser vi har registreret på din elev konto. Vi gør opmærksom på at der kan opstå tidsforskydninger i registrering af ydelser og betalinger, og at hjemmesiden er under opbygning og test, hvorfor din saldo vil blive endeligt opgjort af bogholderiet der har de faktuelle tal. </p>
</div>
<div class="clearfix"></div>
<div class="inner-content">
	<div class="row-fluid">
		<div class="span12">
		    <div class="widget">

		    	<div class="widget-header">
            		<h5><span> {{ __('Elev saldo') }} </span></h5>
        		</div>
		        <div class="tableLicense">
		            <table width="100%" border="0" style="font-size:14px;margin-top:20px;" id="example">                
		                <tr class="table_heading">
		                    <th>{{ __('Stk') }}</th>
		                    <th align="left">{{ __('Ydelse') }}</th>
		                    <th align="left">{{ __('Dato') }}</th>
		                    <th style="text-align: right;">{{ __('Pris') }}</th>
		                </tr>
		                <?php 
		                $i = 1;
		                $g_total = 0;
		                if(!empty($studentAmount)) {
		                    foreach($studentAmount as $student) {
		                        ?>
		                        <tr class="<?php echo ($i%2==0)?'even':'odd'; ?>" align="center">
		                            <td align="left">
		                                {{ $student['count'] }}
		                            </td>
		                            <td align="left">
		                            	{{ $student['text'] }}
		                            </td>
		                            <td align="left">
		                                {{ $student['date'] }}
		                            </td>
		                            <td align="right">
		                                {{ $student['price'] }}
		                            </td>
		                        </tr>
		                        <?php   
								$student['price'] = str_replace(',','', $student['price']);
		                        $totalPrice = number_format($student['price'], 2, '.', '');
		                        $g_total +=  $totalPrice;
		                        $i++;
		                    } ?>
		                    <tr class="table_heading"><td colspan="4"></td></tr>
		                    <tr >
		                        <td></td>
		                        <td>{{ __('Ydelser i alt') }}</td>
		                        <td></td>
		                        <td align="right"> {{ number_format($g_total,2 , '.', '') }} </td>
		                    </tr>
		                     
		                <?php } else { ?>
		                    <tr>
		                        <td colspan="4" align="center" class="index_msg"><?php  echo __('No Pending Student Charges.'); ?></td>
		                    </tr>
		                <?php 
		                } 
		                ?>               
		            </table>
		        </div>

		        <div class="widget-header">
		            <h5>{{ __('Seneste Betalinger') }}</h5>  
		        </div>
		        <div class="tableLicense">
		            <table width="100%" style="font-size:14px;margin-top:20px;" cellpading="0" cellspacing="0" border="0" >
		                <tr class="table_heading">
		                    <th align="left">{{ __('Dato') }}</th>
		                    <th style="text-align: right;">{{ __('Beløb') }}</th>
		                </tr>

		                <?php $i=0; $g_total_1 = 0;?>
		                
		                @if(!empty($payments))
			                @foreach ($payments as $key => $payment)
			                    <tr class="<?php echo ($i++%2==0)?'even':'odd'; ?> " align="center" >
			                        <td align="left">
			                            {{ date('d.m.Y',strtotime($payment->PosteringsDato)) }}
			                        </td>
			                        <td align="right">
			                            <?php echo $tmp_g_total_1 = round($payment->Kredit); ?>
			                            <?php $g_total_1 = $g_total_1 + $tmp_g_total_1; ?>
			                        </td>
			                    </tr>    
			                @endforeach
		                	<tr class="table_heading"><td colspan="4"></td></tr>
		                    <tr>
		                        <td>{{ __('Faktisk afholdt saldo') }}</td>
		                        <td align="right"><?php echo $g_total - $g_total_1; ?></td>
		                    </tr>
		              	@else
		                    <tr>
		                        <td colspan="2" align="center" class="index_msg"><?php  echo __('Ingen Seneste Betalinger'); ?></td>
		                    </tr>
		              	@endif

		            </table>
		        </div>

				<div class="widget-header">
		            <h5>Bestilte endnu ikke afholdte ydelser</h5>  
		        </div>
		        <div class="tableLicense">
		            <table width="100%" style="font-size:14px;margin-top:20px;" cellpading="0" cellspacing="0" border="0">
		                <tr class="table_heading">
		                    <th align="left">{{ __('Stk') }}</th>
		                    <th align="left">{{ __('Område') }}</th>
		                    <th align="left">{{ __('Dato') }}</th>
		                    <th style="text-align: right;">{{ __('Pris') }}</th>
		                </tr>
		                <?php                
		                $i=0;
		                $gtotal = 0;
		                if(!empty($systemBooking)) {
		                    foreach($systemBooking as $booking){
		                        ?>
		                        <tr class="<?php echo ($i++%2==0)?'even':'odd'; ?> " align="center" >
		                            <td align="left">
		                                <?php echo $type = ($booking->lesson_type != '') ? $booking->lesson_type : '1' ;?>
		                            </td>
		                            <td align="left">
		                                <?php 
		                                $type1 = ($type != '') ? $type." x " : '';
		                                echo $type1.ucfirst($booking->booking_type); ?>
		                            </td>
		                            <td align="left">
		                                <?php echo date('d.m.Y',strtotime($booking->start_time)); ?>
		                            </td>
		                            <td align="right">
		                                <?php echo $total =  $type*500;
		                                $gtotal = $gtotal + $total;
		                                 ?>
		                            </td>
		                        </tr>
		                    <?php
		                    } ?>
		                    <tr class="table_heading"><td colspan="4"></td></tr>
		                    <tr>
		                        <td>Fremtidige ydelse i alt</td>
		                        <td></td>
		                        <td></td>
		                        <td align="right">{{ $gtotal }}</td>
		                    </tr>
		                <?php }else{ ?>
		                    <tr>
		                        <td colspan="5" align="center" class="index_msg">{{ __('No Bookings are added.') }}</td>
		                    </tr>
		                <?php                   
		                }
		                ?>
		            </table>
		        </div>

		        <div class="widget-header">
		            <h5>Din saldo i alt
		                <span style="float: right;">
		                    <?php echo ($g_total - $g_total_1) + $gtotal; ?>
		                </span>
		            </h5>  
		        </div>

		        <div class="widget-header">
		            <?php 
		                echo "<span>FIK/Girokort code : ".$stdTitle."</span>";
		            ?>
		        </div>

		    </div>
		</div>
	</div>
</div>
@endsection