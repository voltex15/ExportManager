import { HttpClient } from '@angular/common/http';
import { Component, Inject, OnInit } from '@angular/core';
import { MatSnackBar } from '@angular/material/snack-bar';
import { SearchExport } from '../../../elements/searchExport';
import { Local } from '../../../elements/local';
import { Output, EventEmitter } from '@angular/core';

@Component({
  selector: 'app-search-exports-form',
  templateUrl: './search-exports-form.component.html',
  styleUrls: ['./search-exports-form.component.css']
})
export class SearchExportsFormComponent implements OnInit {

  constructor(
    private _http: HttpClient,
    private _snackBar: MatSnackBar,
    @Inject('API_BASE_URL') private _baseUrl: string
  ) { }

  public locals;
  public exports;

  model = new SearchExport(
    1,
    new Date,
    new Date,
  )

  @Output() newItemEvent = new EventEmitter<string>();

  emitExports(value) {
    this.newItemEvent.emit(value);
  }

  ngOnInit(): void {
    this.getLocals();
  }

  getLocals()
  {
    let url = this._baseUrl + 'api/local/getLocals';

    console.log(this.model);

    this._http.get<Local>(url).subscribe(
      result => {
        console.log(result);
        this.locals = result;
      },
      error => {
        console.log(error);
      }
    );
  }

  onSubmit()
  {
    let url = this._baseUrl + 'api/export/getExports/' + this.model.localId + '/' + this.model.dateFrom + '/' + this.model.dateTo;

    console.log(this.model);

    this._http.post<SearchExport>(url, this.model).subscribe(
      result => {
        console.log(result);
        this.exports = result;
        this.emitExports(this.exports);
        this._snackBar.open(`Wyszukano rekordy`, '', {
          duration: 2400,
          panelClass: 'snackbar-success',
          verticalPosition: 'top',
          horizontalPosition: 'right'
        });
      },
      error => {
        console.log(error);

        this._snackBar.open(`Błąd wyszukiwania`, '', {
          duration: 2400,
          panelClass: 'snackbar-error',
          verticalPosition: 'top',
          horizontalPosition: 'right'
        });
      }
    );
  }

  newSearchExport() {
    this.model = new SearchExport(
      1,
      new Date,
      new Date
    );
  }

}

