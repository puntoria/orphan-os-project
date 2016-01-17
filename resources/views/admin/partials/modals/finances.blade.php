<div class="col-sm-12 finances-wrapper">
	<div class="btn-group">
		<button class="btn btn-default" @click="financesYear = false">Shto Raport</button>

		<button v-for="year in orphan.finances.years" class="btn btn-default" 
		@click="financesYear = year">@{{ year }}</button>
	</div>

	<div class="finance-fields row">
		<div class="add-new-report" v-show="financesYear == false">
			<br>
			<div class="col-md-2">
				<input type="text" class="form-control" v-model="newFinanceYear" placeholder="Viti">
			</div>
			<div class="btn btn-primary" @click="addFinances()">Shto</div>
		</div>

		<div class="col-md-12" v-show="financesYear != false">
			<div class="btn btn-danger pull-right" @click="confirmDeleteFinances(financesYear)">Fshij kete raport</div>
			<table class="table table-striped">
				<thead>
					<tr>
						<th style="width: 15%;">Muaji</th>
						<th style="width: 13%;">Ka Donacion?</th>
						<th style="width: 18%;">Shuma (E)</th>
						<th style="width: 18%;">Shuma (D)</th>
						<th style="width: 18%;">Lloji</th>
						<th style="width: 18%;">Data e marrjes</th>
					</tr>
				</thead>

				<tbody>
					<tr v-for="finance in getFinances(financesYear)">
						<td>@{{ getMonth(finance.month) }}</td>
						<td>
							<input type="checkbox" 
							v-model="orphan.finances.list[finance.finance_array_id].has_donation"
							:checked="orphan.finances.list[finance.finance_array_id].has_donation != false">
						</td>

						<td v-show="orphan.finances.list[finance.finance_array_id].has_donation">
							<input type="text" 
							v-model="orphan.finances.list[finance.finance_array_id].amount_euro">
						</td>

						<td v-show="orphan.finances.list[finance.finance_array_id].has_donation">
							<input type="text" 
							v-model="orphan.finances.list[finance.finance_array_id].amount_dinar">
						</td>

						<td v-show="orphan.finances.list[finance.finance_array_id].has_donation">
							<input type="text" 
							v-model="orphan.finances.list[finance.finance_array_id].type">
						</td>

						<td v-show="orphan.finances.list[finance.finance_array_id].has_donation">
							<input type="text" 
							v-model="orphan.finances.list[finance.finance_array_id].received_at">
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
</div>