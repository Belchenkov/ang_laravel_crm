import { Pipe, PipeTransform } from '@angular/core';

import { LeadComment } from "../models/lead-comment";

@Pipe({
  name: 'event'
})
export class EventPipe implements PipeTransform {

  transform(comments: LeadComment[], type: boolean): LeadComment[] {
    return comments.filter((comment: LeadComment) => comment.is_event === type);
  }

}
